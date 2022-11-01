<?php
class Model {
	public $data;
	public function __construct(){
		$response = file_get_contents("https://rickandmortyapi.com/api/character");
		$this->data = $response;
	}
}
class View {
	private $model;
	private $controller;
	public function __construct($controller,$model) {
		$this->controller = $controller;
		$this->model = $model;
	}
	public function output(){
		return $this->model->data;
	}
}
class Controller {
	private $model;
	public function __construct($model) {
		$this->model = $model;
	}
}
$model = new Model();
$controller = new Controller($model);
$view = new View($controller, $model);
if(isset($_REQUEST['ram'])) $data = $view->output();
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <title>PRUEBA TÉCNICA PHP</title>
	<style>
		.button {
		  border: none;
		  color: white;
		  padding: 16px 32px;
		  text-align: center;
		  text-decoration: none;
		  display: inline-block;
		  font-size: 16px;
		  margin: 4px 2px;
		  transition-duration: 0.4s;
		  cursor: pointer;
		}
		.button1 {
		  background-color: white; 
		  color: black; 
		  border: 2px solid #008CBA;
		}
		.button1:hover {
		  background-color: #008CBA;
		  color: white;
		}
		/*-------------------------------------------------------*/
		.concard {
			padding: 10px;
			color: blue;
			border: solid 1px;
			background-color: #171717;
		}
		img {
			width: 40%;
			height: 150px;
		}
		.inner {
			display: flex;
			flex-flow: wrap;
			justify-content: flex-start;
			background-color: #171717;
		}
		.cards {
			float: left;
			width: calc(48% - 10px);
			height: 150px;
			background-color: #515A5A;
			margin: 10px;
			box-sizing: border-box;
			border-radius: 10px;
		}
		/*-------------------------------------------------------*/
		.card {
		  background-color: #515A5A;
		  color: black;
		  width: 50%;
		  float: right;
		  border-radius: 10px;
		}
		.card-title {
		  font-size: 30px;
		  text-align: right;
		  font-weight: bold;
		  padding-top: 20px;
		  padding-right: 10px;
		}
		.card-desc {
		  padding-right: 10px;
		  text-align: right;
		  font-size: 18px;
		}
		/*--------------------------------------------------------------*/
		.nstyle { color: #7CB342; }
		.dstyle { color: #F5F5F5; }
	</style>
	<script type="text/javascript">
	</script>
  <meta name="viewport" content="width=device-width, initial-scale=1">
</head>
<body>
<form id="frm_ram" action="PruebaPHP.php" method="get">
	<input type="submit" class="button button1" value="Rick and Morty">
	<div class="inner" id="concard" name="concard">
		<?php
			if(isset($_REQUEST['ram'])){
				$list = json_decode($data, true);
				$info = $list['results'];
				foreach ($info as $reg => $jsons){
					$per = '<div class="cards">';
						$per .= '<img src="'.$jsons['image'].'" alt="Avatar" class="img">';
						$per .= '<div class="card">';
						$per .= '<div class="card-title"><b class="nstyle">'.$jsons['name'].'</b></div>';
						$per .= '<div class="card-desc"><label class="dstyle">'.$jsons['status'].' - '.$jsons['species'].'</label></div>';
						$per .= '</div>';
					$per .= '</div>';
					echo $per;
				}
			}
		?>
	</div>
	<input type="hidden" name="ram" value=1 />
</form>
</body>
</html>