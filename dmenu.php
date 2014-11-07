<?php

<in test 1 >
dsfhh
<>
<head>
   <meta charset='ASDFASDFASFDutf-8'>
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1">
   <link rel="stylesheet" href="dstyles.css">
    <title>ICMS-Chennai</title>
</head>
<body leftmargin="0" rightmargin="0" background="bg3.jpg">

<div id='cssmenu'>
<ul>
   
	   		$findstr='CGM';
	  	    $pos = strpos($usrid,$findstr);
	   		if ($pos === false)
	    	{
			?>
      	 <li><a href='lettassign.php'><span>Assign / Close</span></a></li>
         <li class='last'><a href='lettreassign.php'><span>Re-Assign</span></a></li>
<!--        <li class='last'><a href='lettreceipt.php'><span>Phy. Receipt</span></a></li>-->
		    <?php
			}
			?>
      </ul>
   </li>
  <li class='has-sub'><a href='#'><span>Reports</span></a>
      <ul>
	     <li class='active has-sub'><a href='#'><span>Pending Status</span></a>
		 <ul>
 			<li><a href='pending_report.php'><span>Detailed</span></a></li>
	      	<li><a href='pending_rpt1.php'><span>Entry Datewise</span></a></li>
	      	<li><a href='letter_pending_rpt1.php'><span>Letter Datewise</span></a></li>
		 </ul>
		 </li>
	 	     <li class='active has-sub'><a href='#'><span>Inward Register</span></a>
		 <ul>
         	<li><a href='cgm_register_report.php'><span>Entry Datewise</span></a></li>
         	<li><a href='cgm_register_rpt.php'>Department Sl.No.wise</a></li>
         	<li><a href='deptwise_register2.php'><span>Assigned List</span></a></li>
         	<li><a href='deptwise_register.php'><span>Despatch List</span></a></li>
         	<li><a href='cgm_register_slno.php'><span>Sl.No.wise List</span></a></li>
		 </ul>
		 </li>
         <li><a href='summary_report.php'><span>Summary</span></a></li>
      </ul>
   </li>
   
  <!--   <li class='has-sub'><a href='#'><span>Reports</span></a>
      <ul>
	     <li class='active has-sub'><a href='#'><span>Pending Status</span></a>
		 <ul>
 			<li><a href='pending_report.php'><span>Detailed</span></a></li>
	      	<li><a href='pending_rpt1.php'><span>Entry Datewise</span></a></li>
	      	<li><a href='letter_pending_rpt1.php'><span>Letter Datewise</span></a></li>
		 </ul>
		 </li>
		 <li class='active has-sub'><a href='#'><span>Inward Registers</span></a>
		 <ul>
         	<li><a href='register_report.php'><span>Entry Datewise</span></a></li>
         	<li><a href='register_rpt.php'><span>Serial No.wise</span></a></li>
		 </ul>
		 </li>
         <li><a href='summary_report.php'><span>Summary</span></a></li>
        <li class='last'><a href='#'><span>CC Dept.wise Pending</span></a></li>
		</ul>
   </li>-->
<!--   <li class='has-sub'><a href='#'><span>Messaging</span></a>
      <ul>
         <li><a href='msgsend.php'><span>Send Message</span></a></li>
         <li><a href='msgview.php'><span>View Message</span></a></li>
         <li><a href='#'><span>Inbox</span></a></li>
         <li class='last'><a href='#'><span>Outbox</span></a></li>
      </ul>
   </li>
-->   <li class='last'><a href='dept_query1.php'><span>Enquiry</span></a></li>
<!--     <li class='last'><a href='dept_query1.php'><span>test</span></a></li>-->
   <li class='has-sub'><a href='change-pwd.php'><span>Change Password</span></a></li>
   <li class='last'><a href='logout.php' target="_top"><span>Logout</span></a></li>
</ul>
</div>
<div align="right">
<?php
echo "<font class='style101'>$_SESSION[usrtyp]</font>&nbsp;:&nbsp;";
echo "<font class='style100'>$_SESSION[usrid]</font>";

extract($_POST);

$con = mysql_connect("localhost","root");
if (!$con)  
  { 
 	die('Could not connect: ' . mysql_error());  
  } $db=mysql_select_db("inwdlogin",$con);

$get_stdate=mysql_fetch_array(mysql_query("select * from control_file"));
$stdate=$get_stdate['stdate'];

$query1=mysql_fetch_array(mysql_query("select count(*) as summ1 from inwardreg where fmdept='".$usrid."' and lettdate >= '".$stdate."' and status in ('PENDING', 'INTERIM')"));
$summ1=$query1['summ1'];
 
$query2=mysql_fetch_array(mysql_query("select count(*) as summ2 from inwardreg where ((todept='".$usrid."' and assign1 is null) or (assign1='".$usrid."' and assign2 is null) or (assign2='".$usrid."' and assign3 is null) or (assign3='".$usrid."' and assign4 is null) or (assign4='".$usrid."' and assign5 is null) or assign5='".$usrid."') and lettdate >= '".$stdate."' and status in ('PENDING', 'INTERIM')"));
$summ2=$query2['summ2'];

$query3=mysql_fetch_array(mysql_query("select count(*) as summ3 from inwardreg where ((todept='".$usrid."' and assign1 is not null) or (assign1='".$usrid."' and assign2 is not null) or (assign2='".$usrid."' and assign3 is not null) or (assign3='".$usrid."' and assign4 is not null) or (assign4='".$usrid."' and assign5 is not null) or assign5='".$usrid."') and lettdate >= '".$stdate."'and status in ('PENDING', 'INTERIM')"));
$summ3=$query3['summ3'];
  
$query4="SELECT count(*) FROM inwardreg where (letcopy1='".$_SESSION[usrid]."' or letcopy2='".$_SESSION[usrid]."' or letcopy3='".$_SESSION[usrid]."' or letcopy4='".$_SESSION[usrid]."' or letcopy5='".$_SESSION[usrid]."' or letcopy6='".$_SESSION[usrid]."' or letcopy7='".$_SESSION[usrid]."' or letcopy8='".$_SESSION[usrid]."' or letcopy9='".$_SESSION[usrid]."' or letcopy10='".$_SESSION[usrid]."') and status != 'CLOSED'";
$result4= mysql_query($query4);
$totfile4= mysql_fetch_array($result4);	 
$tot_copyto = $totfile4[0];



?>
<br>
<br>
<br>
<br>
<table  width="50%" border="1" align="center" cellpadding="4" bgcolor="#9acafa" bordercolordark="#4F7899" class="get7">
<tr>
<td  colspan="2" class="get9" align="center"><b>Summary</b></td>
<tr>
<td class="get9" align="left" width="75%">Directly Received & Assigned to Others (Pending)</td>
<td class="get9" align="center" bgcolor="#FFB062" width="15%"><a href='summary_disp11.php' style="text-decoration:none"><?php echo $summ1; ?></a></td>
<?php
$usrid= $_SESSION[usrid];
$findid='CGM';
$pos = strpos($usrid, $findid);
if ($pos === false)
{
?>
<tr>
<td class="get9" align="left" width="75%">Received from Top Level (Unassigned or Not Closed)</td>
<td class="get9" align="center"  bgcolor="#FFB062" width="15%"><a href='summary_disp21.php' style="text-decoration:none"><?php echo $summ2; ?></a></td>
</tr>
<tr>
<td class="get9" align="left" width="75%">Received from Top Level Marked to Others (Pending)</td>
<td class="get9" align="center" bgcolor="#FFB062" width="15%"><a href='summary_disp31.php' style="text-decoration:none"><?php echo $summ3; ?></a></td>
</tr>

<?php
}
?>
<tr>
<td class="get9" align="left" width="75%">Copy of Letters Received</td>
<td class="get9" align="center" width="15%"><a href='summary_disp41.php' style="text-decoration:none"><?php echo $tot_copyto; ?></a></td>
<!--<tr>
<td class="get9" align="left" width="75%">Messages Received</td>
<td class="get9" align="center" width="25%">&nbsp;</td>
</tr>
<tr>
<td class="get9" align="left" width="75%">Messages Sent</td>
<td class="get9" align="center" width="25%">&nbsp;</td>
</tr>
--></table>
<?php
//$usrid =$_SESSION[usrid];
//querydisp1="select count(*) as disp1 from inwardreg where fmdept='$usrid' and status = 'CLOSED'";
//$resultdisp1 = mysql_query($querydisp1);
//while ($rowsum=mysql_fetch_array($resultsum))
?>
</div>
</body>
</html>
