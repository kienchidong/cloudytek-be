<?php
define('ADMINAREA', true);
require dirname(__DIR__).'/init.php';
$admin = new WHMCS\Admin('List Clients');
header('Content-Type: application/json; charset=utf-8');
header('Cache-Control: no-store');
try {
    $db = WHMCS\Database\Capsule::connection()->getPdo();
    $text = function ($key) { return isset($_GET[$key]) && is_string($_GET[$key]) ? trim($_GET[$key]) : ''; };
    $q = substr($text('q'), 0, 150);
    $status = $text('status');
    if (!in_array($status, array('', 'Active', 'Inactive', 'Closed'), true)) $status = '';
    $group = max(0, (int)$text('group'));
    $page = max(1, min(1000000, (int)$text('page')));
    $limit = (int)$text('limit');
    if (!in_array($limit, array(25,50,100), true)) $limit = 25;
    $sorts = array('newest'=>'c.id DESC', 'oldest'=>'c.id ASC', 'name'=>'c.firstname ASC,c.lastname ASC,c.id ASC');
    $sort = $text('sort');
    $order = isset($sorts[$sort]) ? $sorts[$sort] : $sorts['newest'];
    $where = array(); $params = array();
    if ($q !== '') {
        $where[] = "(CONCAT_WS(' ',c.firstname,c.lastname) LIKE ? OR c.companyname LIKE ? OR c.email LIKE ? OR CAST(c.id AS CHAR)=?)";
        $params = array('%'.$q.'%', '%'.$q.'%', '%'.$q.'%', $q);
    }
    if ($group) { $where[] = 'c.groupid=?'; $params[] = $group; }
    $baseWhere = $where ? ' WHERE '.implode(' AND ', $where) : '';
    $statement = $db->prepare('SELECT c.status,COUNT(*) AS total FROM tblclients c'.$baseWhere.' GROUP BY c.status');
    $statement->execute($params);
    $counts = array('All'=>0, 'Active'=>0, 'Inactive'=>0, 'Closed'=>0);
    foreach ($statement->fetchAll(PDO::FETCH_ASSOC) as $row) { $counts['All'] += (int)$row['total']; if (array_key_exists($row['status'], $counts)) $counts[$row['status']] = (int)$row['total']; }
    if ($status) { $where[] = 'c.status=?'; $params[] = $status; }
    $sqlWhere = $where ? ' WHERE '.implode(' AND ', $where) : '';
    // Counts already include the search/group filters; avoid counting the same rows again.
    $total = $counts[$status !== '' ? $status : 'All'];
    $pages = max(1, (int)ceil($total / $limit)); $page = min($page, $pages); $offset = ($page-1)*$limit;
    $statement = $db->prepare('SELECT c.id,c.firstname,c.lastname,c.companyname,c.email,c.status,c.datecreated FROM tblclients c'.$sqlWhere.' ORDER BY '.$order.' LIMIT '.$limit.' OFFSET '.$offset);
    $statement->execute($params); $rows = $statement->fetchAll(PDO::FETCH_ASSOC);
    $services = array();
    if ($admin->hasPermission('List Services') && $rows) {
        $ids = array_map(function ($row) { return (int)$row['id']; }, $rows);
        $placeholders = implode(',',array_fill(0,count($ids),'?'));
        $sources = array("SELECT userid,COUNT(*) AS total,SUM(domainstatus='Active') AS active FROM tblhosting WHERE userid IN ($placeholders) GROUP BY userid");
        if ($admin->hasPermission('List Addons')) $sources[] = "SELECT h.userid,COUNT(*) AS total,SUM(a.status='Active') AS active FROM tblhostingaddons a JOIN tblhosting h ON h.id=a.hostingid WHERE h.userid IN ($placeholders) GROUP BY h.userid";
        if ($admin->hasPermission('List Domains')) $sources[] = "SELECT userid,COUNT(*) AS total,SUM(status='Active') AS active FROM tbldomains WHERE userid IN ($placeholders) GROUP BY userid";
        foreach ($sources as $sql) {
            $statement = $db->prepare($sql); $statement->execute($ids);
            foreach ($statement->fetchAll(PDO::FETCH_ASSOC) as $row) {
                if (!isset($services[$row['userid']])) $services[$row['userid']] = array('active'=>0,'total'=>0);
                $services[$row['userid']]['active'] += (int)$row['active'];
                $services[$row['userid']]['total'] += (int)$row['total'];
            }
        }
    }
    $canServices = (bool)$admin->hasPermission('List Services');
    foreach ($rows as &$row) { $row['id'] = (int)$row['id']; $row['services'] = $canServices ? (isset($services[$row['id']]) ? $services[$row['id']] : array('active'=>0,'total'=>0)) : null; }
    unset($row);
    $groups = $db->query('SELECT id,groupname FROM tblclientgroups ORDER BY groupname')->fetchAll(PDO::FETCH_ASSOC);
    echo json_encode(array('customers'=>$rows, 'counts'=>$counts, 'total'=>$total, 'page'=>$page, 'pages'=>$pages, 'limit'=>$limit, 'groups'=>$groups, 'canAdd'=>(bool)$admin->hasPermission('Add New Client')), JSON_UNESCAPED_UNICODE);
} catch (Throwable $e) {
    http_response_code(500);
    echo json_encode(array('error'=>'Customer data is temporarily unavailable'));
}
