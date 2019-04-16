<html>
<head><title></title></head>
<body>

 <?php
 $i=1;
 if (($handle = fopen("DataTugas2.csv", "r")) !== FALSE)
 {
  $y = 0;
  $jum = 0;
  while (($data = fgetcsv($handle, 1000, ",")) !== FALSE)
  {

   $i++;
   $sangatKecil = 0;
   $kecil = 0;
   $sedang = 0;
   $besar = 0;
   $sangatBesar= 0;

   $hSangatKecil = 0;
   $hKecil = 0;
   $hSedang = 0;
   $hBesar = 0;
   $hSangatBesar= 0;

   $no = $data[0];
   $nPendapatan = $data[1];
   $nHutang = $data[2];

   //---- CEK NILAI ----
	 if ( ( $nPendapatan >= 0 ) && ( $nPendapatan <= 0.3 ) ) {
			 $sangatKecil = 1;
	 } else if ( ($nPendapatan > 0.3) && ($nPendapatan<=0.4) ) {
		 $sangatKecil = ((0.4-$nPendapatan) / 0.1);
		 $kecil = ((($nPendapatan-0.3)) / 0.1 );
	 } else if ( ($nPendapatan > 0.4) && ($nPendapatan <=0.7) ){
		 $kecil = 1;
	 } else if ( ($nPendapatan > 0.7) && ($nPendapatan <=0.8) ){
		 $kecil = ((0.8-$nPendapatan)/0.1);
		 $sedang = ((($nPendapatan-0.7))/0.1);
	 } else if ( ($nPendapatan > 0.8) && ($nPendapatan <= 1.1) ){
		 $sedang = 1;
	 } else if ( ($nPendapatan > 1.1) && ($nPendapatan <= 1.2) ){
		 $sedang = ((1.2-$nPendapatan)/0.1);
		 $besar = ((($nPendapatan-1.1))/0.1);
	 } else if ( ($nPendapatan > 1.2) && ($nPendapatan <= 1.5) ){
		 $besar = 1;
	 } else if ( ($nPendapatan > 1.5) && ($nPendapatan <= 1.6) ){
		 $besar = ((1.6-$nPendapatan)/0.1);
		 $sangatBesar = ((($nPendapatan-1.5))/0.1);
	 } else if ( ($nPendapatan > 1.6) && ($nPendapatan <= 2.0) ){
		 $sangatBesar = 1;
	 }


	 if ( ($nHutang > 0) && ($nHutang <= 10) ){
		 $hSangatKecil = 1;
	 } else if ( ($nHutang > 10) && ($nHutang <= 20) ){
		 $hSangatKecil = ((20-$nHutang)/10);
		 $hKecil = ((($nHutang-10))/10);
	 } else if ( ($nHutang > 20) && ($nHutang <= 30) ){
		 $hKecil = 1;
	 } else if ( ($nHutang > 30) && ($nHutang <= 40) ){
		 $hKecil = ((40-$nHutang)/10);
		 $hSedang = (( ($nHutang-30))/10);
	 } else if ( ($nHutang > 40) && ($nHutang <= 50) ){
		 $hSedang = 1;
	 } else if ( ($nHutang > 50) && ($nHutang <= 60) ){
		 $hSedang = ((60-$nHutang)/10);
		 $hBesar = ((($nHutang-50))/10);
	 } else if ( ($nHutang > 60) && ($nHutang <= 70) ){
		 $hBesar = 1;
	 } else if ( ($nHutang > 70) && ($nHutang <= 80) ){
		 $hBesar = ((80-$nHutang)/10);
		 $hSangatBesar = ((($nHutang-70))/10);
	 } else if ( ($nHutang > 80) && ($nHutang <= 100) ){
		 $hSangatBesar = 1;
	 }

	 // besar =1
	 // sangat besar =1
	 $tidak2 = min($hKecil,$kecil);
	 $tidak3 = min($hKecil,$sedang);
	 $tidak4 = min($hKecil,$besar);
	 $tidak5 = min($hKecil,$sangatBesar);

	 $tidak7 = min($hSedang,$sedang);
	 $tidak8 = min($hSedang,$besar);
	 $tidak9 = min($hSedang,$sangatBesar);

	 $tidak11 = min($hBesar,$besar);
	 $tidak12 = min($hBesar,$sangatBesar);

	 $tidak13 = min($hSangatKecil,$sangatKecil);
	 $tidak14 = min($hSangatKecil,$kecil);
	 $tidak15 = min($hSangatKecil,$sedang);
	 $tidak16 = min($hSangatKecil,$besar);
	 $tidak17 = min($hSangatKecil,$sangatBesar);
	 $tidak19 = min($hSangatBesar,$sangatBesar);

	 $maxTidak = max($tidak2,$tidak3,$tidak4,$tidak5,$tidak7,$tidak8,$tidak9,$tidak11,$tidak12,$tidak13,$tidak14,$tidak15,$tidak16,$tidak17,$tidak19);

	 $ya7 = min($hKecil,$sangatKecil);
	 $ya8 = min($hSedang,$kecil);
	 $ya9 = min($hBesar,$sedang);
	 $ya10 = min($hSangatBesar,$besar);
	 $ya1 = min($hSedang,$sangatKecil);
	 $ya2 = min($hBesar,$sangatKecil);
	 $ya3 = min($hBesar,$kecil);
	 $ya4 = min($hSangatBesar,$sangatKecil);
	 $ya5 = min($hSangatBesar,$kecil);
	 $ya6 = min($hSangatBesar,$sedang);
	 $maxYa = max($ya1,$ya2,$ya3,$ya4,$ya5,$ya6,$ya7,$ya8,$ya9,$ya10);

   $x = $maxYa+$maxTidak;
   if($x == 0)
   {
    $x = 1;
   }

   $nilai = ((40*$maxTidak)+(80*$maxYa))/$x;
   if ($nilai > 60)
   {
    $pesan = "Layak";
    $hasil[$y] = array();
    $hasil[$y]['no'] = $no;
    $hasil[$y]['pendapatan'] = $nPendapatan;
    $hasil[$y]['hutang'] = $nHutang;
    $hasil[$y]['kelayakan'] = $pesan;
    $y++;
    $jum++;
   }
   else
   {
    $pesan = "Tidak Layak";
   }
  } //end while
  fclose($handle);

  // SORTING NILAI
  function sorting($a, $b)
  {
      return strcasecmp($b['nilai'], $a['nilai']);
  }
  usort($hasil, 'sorting');

 } //end if

 $header = array("No.keluarga");
 $fp = fopen("TebakanTugas2.csv", "w");
 fputcsv ($fp, $header, ","," ");
 foreach($hasil as $row)
 {
	 if ($angka <20) {
     fputcsv($fp, $row,","," ");
		 $angka++;
	 }
  }
 fclose($fp);
 ?>


 <table width="50%" border="1">
 <tr>
  <th>NO</th>
  <th>NO. KELUARGA</th>
  <th>PENDAPATAN</th>
  <th>HUTANG</th>
  <th>KELAYAKAN</th>

 </tr>
   <?php
    $x= 1;
		echo "Output Data berupa file csv ";
    for ($i=0; $i < 20 ; $i++)
    {
     echo "<tr>";
     echo "<td>$x</td>";
     echo "<td>";print_r($hasil[$i]['no']); echo"</td>";
     echo "<td>"; print_r($hasil[$i]['pendapatan']); echo"</td>";
     echo "<td>"; print_r($hasil[$i]['hutang']); echo"</td>";
     echo "<td>"; print_r($hasil[$i]['kelayakan']); echo"</td>";
     echo "</tr>";
     $x++;
    }
   ?>
 </table>
</body>
</html>
