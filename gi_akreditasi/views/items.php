<!DOCTYPE html>  
<html>  
<head>  
	<title> Create Dynamic Treeview using the Codeigniter 3 and PHP </title>  
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.0/css/bootstrap.min.css">  
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-treeview/1.2.0/bootstrap-treeview.min.css" />  
	<script type="text/javascript" charset="utf8" src="https://ajax.aspnetcdn.com/ajax/jQuery/jquery-1.9.1.min.js"></script>  
	<script type="text/javascript" charset="utf8" src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-treeview/1.2.0/bootstrap-treeview.min.js"></script>  
</head>  
<body>  

	<div class="container">  
		<div class="panel panel-default">  
			<div class="panel-heading">  
				<h1> Create Dynamic Treeview using the Codeigniter 3 and PHP </h1>  
			</div>  
			<div class="panel-body">  
				<div class="col-md-8" id="treeview_json">  
				</div>  
			</div>  
		</div>  
	</div>  

	<script type="text/javascript">  
		$(document).ready(function(){  

			var treeData;  

			$.ajax({  
				type: "GET",    
				url: "<?= base_url() ?>/getItem",  
				dataType: "json",         
				success: function(response)    
				{  
					initTree(response)  
				}     
			});  

			function initTree(treeData) {  
				$('#treeview_json').treeview({data: treeData});  
			}  

		});  
	</script>  

</body>  
</html>  