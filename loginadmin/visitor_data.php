<?php
include("../config.php");
$db		=	new	lg_mysql($host,$dbuser,$dbpass,$csdl);

$label	=	array();
$data	=	array();
$y_min	=	0;
$y_max	=	0;

$sql	=	"ngay like '%/".lg_date::vn_other(time(),"m")."/".lg_date::vn_other(time(),"Y")."'";
$r		=	$db->select("goon_online_daily",$sql,"order by ngay asc");
while ($row = $db->fetch($r))
{
	$label[]	=	str_replace("/".lg_date::vn_other(time(),"Y"),"", $row["ngay"]);
	$data[]		=	$row["bo_dem"];
	if ($y_max < $row["bo_dem"])	$y_max = $row["bo_dem"];
}

//2
include_once( '../lib/ofc-library/open-flash-chart.php' );
$g = new graph();
$g->set_data( $data );
$g->bg_colour = '#ffffff';
$g->set_inner_background( '#EBEBEB', '#ffffff', 90 );
srand((double)microtime()*1000000);
$bar_red = new bar_3d( 70, '#D54C78' );

// add random height bars:
for( $i=0; $i<20; $i++ )
  $bar_red->data[] = rand(5,10);

//
// create a 2nd set of bars:
//
$bar_blue = new bar_3d( 75, '#3334AD' );

// add random height bars:
for( $i=0; $i<20; $i++ )
  $bar_blue->data[] = rand(1,5);


$g->title( 'Thống kê truy cập website', '{font-size:12px;color: #000; margin: 5px; padding:5px; padding-left: 20px; padding-right: 20px;}' );


$g->data_sets[] = $bar_red;
$g->data_sets[] = $bar_blue;

$g->set_x_axis_3d( 12 );
$g->x_axis_colour( '#909090', '#ADB5C7' );
$g->y_axis_colour( '#909090', '#ADB5C7' );
$g->set_x_labels( $label );
$g->set_y_max = (round((($y_max)/10),0)+1)*10;
$g->set_y_min = 0;
$g->y_label_steps = 2;
$g->set_y_legend( '', 12, '#000' );
echo $g->render();
?>