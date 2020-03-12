<!DOCTYPE html>
<html>
<head>
	<title></title>
	<style type="text/css">
		body{
			margin-top: 30px;
			margin-left: 70px;
		}
		p{
			font-size: 25px;
			font-family: "Georgia", serif;
		}
		h3{
			margin-top: 20px;
		}
	</style>
</head>
<body>
		<div>
			<h2 style="margin-left: 75px;margin-top: 200px;"><u><b>TO WHOM SOEVER IT MAY CONCERN</b></u></h2>
		</div>
		<div style="margin-top: 90px;">
			<p>
				This is to certify that Mr./Mrs. <b>{{$name}}</b>,
				Enrollement no : <b>{{$enroll}} </b>, is a bonafied student of 
				L.J Institute Of Computer Applications. He/She is studying 
				in the 
				@if($semester == 1)
					<b>{{$semester}}st</b>
				@elseif($semester == 2)
					<b>{{$semester}}nd</b> 
				@elseif($semester == 3)
					<b>{{$semester}}rd</b>
				@else
					<b>{{$semester}}th</b>
				@endif Semester in the <b>{{$course}},{{ $years }}</b>.	 
			</p>
		</div>
		<div>
			<p>
				He/She is studying in English Medium.
			</p>
		</div>
	<div style="margin-top: 60px;">
		<h2><b>Director</b></h2>
	</div>
</body>
</html>