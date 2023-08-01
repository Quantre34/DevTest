<?php 
class Documentation{

	public function __construct(){
		$this->data =  file('index.php');
		$this->data[] = file('classes/ConstructionStages.php');
		$this->result = [];
	}
	public function clean($value){
		foreach (['Insert','Alter','Api','Delete','GetSingle','GetAll','Delete'] as $label) {
			foreach (['param','return','Info','Label','returns'] as $param) {
				if (str_contains($value, $param)) {
					if (str_contains($value, $label)) {
						if ($param!='Label') {
							$result = str_replace('@'.$label.'@'.$param, '',  $value);
							return str_replace('*', '', $result);
						}
					}
				}
			}
		}
	}
	public function Place($arr){
		foreach ($arr as $key => $value) {
			foreach (['Insert','Alter','Api','Delete','GetSingle','GetAll'] as $label) {
				if (str_contains($value, $label)) {
					$this->result[$label][$key] = $this->clean($value);
				}
			}
		}
	}
	///
	public function GetInfo($arr=false){
		if ($arr==false) {
			foreach($this->data as $key => $row){

				if (!is_array($row)) {
					if (str_contains($row, '@author')) {
						$this->result[] = ['Developer' => str_replace('@author', '', $row)];
					}
					if (str_contains($row, '@')) {
						if (str_contains($row, '@param')) {
							$this->Place(['Parameters' => $row]);
						}
						if (str_contains($row, '@Info')) {
							$this->Place(['Info' => $row]);
						}
						if (str_contains($row, '@return')) {
							$this->Place(['Returns' => $row]);
						}
					}
				}else {
					$this->GetInfo($row);
				}
			}
		}else {
			foreach($arr as $key =>$row){
				if (!is_array($row)) {
					if (str_contains($row, '@')) {
						if (str_contains($row, '@param')) {
							$this->Place(['Parameters' =>$row]);
						}
						if (str_contains($row, '@Info')) {
							$this->Place(['Info' => $row]);
						}
						if (str_contains($row, '@return')) {
							$this->Place(['Returns' => $row]);
						}
					}
				}else {
					$this->GetInfo($row);
				}
			}	
		}

		return $this->result;
	}
}

$get = new Documentation;
$result = $get->GetInfo();

?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css">
	<script url="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.min.js"></script>
	<title></title>
</head>
<body>
	<div class="row">
		
		<img src="https://learn.g2.com/hubfs/G2CM_FI167_Learn_Article_Images_%5BAPI%5D_Infographic_V1a.png" class="img-fluid" alt="Responsive image">

	</div>
	<center><div class="row">
		
		<h2>Welcome to my API documentation</h2>
		<br>
		<br>
	</div></center>
<table class="table">
  <thead>
    <tr>
      <th scope="col">#</th>
      <th scope="col">Method</th>
      <th scope="col">Parameters</th>
      <th scope="col">Returns</th>
      <th scope="col">Additional Info</th>
    </tr>
  </thead>
  <tbody>

  	<?php  
  	$i = 0;
  		foreach($result as $key => $row){
  			if (@$row['Developer']) {
  				continue;
  			}
  	?>
    <tr>
      <th scope="row"><?=$i?></th>
      <td><?= @$key ?></td>
      <td><?= @$row['Parameters'] ?></td>
      <td><?= @$row['Returns'] ?></td>
      <td><?= @$row['Info'] ?></td>
    </tr>
<?php
	$i++;
 } 
?>
  </tbody>
</table>
	<center>
		<h4>Url Library</h4>
		<p>post: 'http://sorupaneli.com/DevTest/'</p>
		<p>'http://sorupaneli.com/DevTest/?ConstructionStages/GetAll'</p>
		<p>'http://sorupaneli.com/DevTest/?ConstructionStages/GetAll/table/construction_stages'</p>
		<p>'http://sorupaneli.com/DevTest/?ConstructionStages/GetSingle/Id'</p>
		<p>'http://sorupaneli.com/DevTest/?ConstructionStages/GetSingle/Id/construction_stages'</p>
	</center>
</body>
</html>
