<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>Print</title>
	<style>
	    body {
        width: 100%;
        height: 100%;
        margin: 0;
        padding: 0;
        background-color: #ccc;
        font: 10pt "Tahoma";
	    }
	    * {
	        box-sizing: border-box;
	        -moz-box-sizing: border-box;
	    }
	    .page {
	        width: 80mm;
	        margin: 10mm auto;
	        border-radius: 5px;
	        background: white;
	        box-shadow: 0 0 5px rgba(0, 0, 0, 0.1);
	    }
	    .subpage {
	        padding: 3mm;
	    }
	    

	    @media print {
	        html, body {
	            width: 80mm;
	     
	        }
	        .page {
	            margin: 0;
	            border: initial;
	            border-radius: initial;
	            width: initial;
	            min-height: initial;
	            box-shadow: initial;
	            background: initial;
	            page-break-after: always;
	        }
	    }
    </style>
</head>
<body>
	<div class="book">
    <div class="page">
        <div class="subpage"></div>
    </div>
</div>
</body>
</html>