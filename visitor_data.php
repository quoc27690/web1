<?php
include("../config.php");
$db		=	new	lg_mysql($host,$dbuser,$dbpass,$csdl);

$label	=	array();
$data	=	array();
$click	=	array();
$seo	=	array();
$arc	=	array();
$y_min	=	0;
$y_max	=	0;

$sql	=	"ngay like '%/".lg_date::vn_other(time()-60*60*24*62,"m")."/".lg_date::vn_other(time()-60*60*24*62,"Y")."'";
$r		=	$db->select("score_online_daily",$sql,"order by ngay asc");
while ($row = $db->fetch($r))
{
	$label[]	=	str_replace("/".lg_date::vn_other(time()-60*60*24*63,"Y"),"", $row["ngay"]);
	$data[]		=	$row["bo_dem"];
	$click[]	=	$row["click"];
	$seo[]	=	$row["seo"];
	$arc[]	=	$row["arc"];
	if ($y_max < $row["bo_dem"])	$y_max = $row["bo_dem"];
	if ($y_max < $row["click"])	$y_max = $row["click"];
	if ($y_max < $row["seo"])	$y_max = $row["seo"];
	if ($y_max < $row["arc"])	$y_max = $row["arc"];
}
$sql	=	"ngay like '%/".lg_date::vn_other(time()-60*60*24*28,"m")."/".lg_date::vn_other(time()-60*60*24*28,"Y")."'";
$r		=	$db->select("score_online_daily",$sql,"order by ngay asc");
while ($row = $db->fetch($r))
{
	$label[]	=	str_replace("/".lg_date::vn_other(time()-60*60*24*28,"Y"),"", $row["ngay"]);
	$data[]		=	$row["bo_dem"];
	$click[]	=	$row["click"];
	$seo[]	=	$row["seo"];
	$arc[]	=	$row["arc"];
	if ($y_max < $row["bo_dem"])	$y_max = $row["bo_dem"];
	if ($y_max < $row["click"])	$y_max = $row["click"];
	if ($y_max < $row["seo"])	$y_max = $row["seo"];
	if ($y_max < $row["arc"])	$y_max = $row["arc"];
}
$sql	=	"ngay like '%/".lg_date::vn_other(time(),"m")."/".lg_date::vn_other(time(),"Y")."'";
$r		=	$db->select("score_online_daily",$sql,"order by ngay asc");
while ($row = $db->fetch($r))
{
	$label[]	=	str_replace("/".lg_date::vn_other(time(),"Y"),"", $row["ngay"]);
	$data[]		=	$row["bo_dem"];
	$click[]	=	$row["click"];
	$seo[]	=	$row["seo"];
	$arc[]	=	$row["arc"];
	if ($y_max < $row["bo_dem"])	$y_max = $row["bo_dem"];
	if ($y_max < $row["click"])	$y_max = $row["click"];
	if ($y_max < $row["seo"])	$y_max = $row["seo"];
	if ($y_max < $row["arc"])	$y_max = $row["arc"];
}

include_once( '../lib/ofc-library/open-flash-chart.php' );
$g = new graph();

$g->set_data( $data );
$g->set_data( $click );
$g->set_data( $seo );
$g->set_data( $arc );

$g->line_dot( 2, 4, '0xCC3399', 'Visitor', 10);    // <-- 3px thick + dots
$g->line_hollow( 2, 4, '0x80a033', 'Click', 10 );
$g->line_hollow( 2, 4, '0x666666', 'RSS', 10 );
$g->line_hollow( 2, 4, '0xff0000', 'ARC', 10 );

$g->set_x_labels( $label );
$g->set_x_label_style( 10, '#303030', 2 );

$g->y_min = 0;
$g->y_max = (round((($y_max)/10),0)+1)*10;
$g->y_steps = 2;
$g->title( ' ', '{font-size: 11px; }' );
echo $g->render();
?>