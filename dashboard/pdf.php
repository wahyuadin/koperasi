<?php
session_start();
if (!isset($_SESSION['users'])) {
    return header('location:'. base_url());
}
require_once __DIR__ . '/../vendor/autoload.php';

use Dompdf\Dompdf;
use Dompdf\Options;

$option = new Options();
$option->setChroot(__DIR__.'/../');
$option->setIsRemoteEnabled(true);

$dompdf = new Dompdf($option);
$dompdf->setPaper("A4", "landscape");

$html = file_get_contents("template.html");

include(__DIR__.'/../Controller/MasterController.php');
include(__DIR__.'/../Controller/DashboardController.php');

$conn = globalfun();
if (adminGetData()) {
    $tableRows  = '';
    $no         = 1;
    foreach (adminGetData() as $row) {
        $prov       = provinsi($row[4]);
        $kab        = kabupaten($row[4] , $row[5]);
        $kec        = kecamatan($row[5], $row[6]);
        $kel        = kelurahan($row[6], $row[7]);


        $tableRows .= '<tr>';
        $tableRows .= '<td data-column="ID">' . $no++ . '</td>';
        $tableRows .= '<td data-column="Name">' . $row[2] . '</td>';
        $tableRows .= '<td data-column="Email">' . $row[3] . '</td>';
        $tableRows .= '<td data-column="Email">' . $prov . '</td>';
        $tableRows .= '<td data-column="Email">' . $kab . '</td>';
        $tableRows .= '<td data-column="Email">' . $kec . '</td>';
        $tableRows .= '<td data-column="Email">' . $kel . '</td>';
        $tableRows .= '<td data-column="Email">' . $row[8] . '</td>';
        $tableRows .= '</tr>';
    }
    
    $html = str_replace("{{ table_rows }}", $tableRows, $html);
    $dompdf->loadHtml($html);
    $dompdf->render();
    $dompdf->addInfo('Title', 'ini pdf');
    if ($dompdf->stream('NST-'.generateRandomString(7).'.pdf', ['Attachment' => 0])) {
        return header('location:'.base_url('nasabah/index.php'));
    };
}

?>