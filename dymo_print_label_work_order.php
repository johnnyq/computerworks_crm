<?php

header("Content-type:text/plain");
output: "Content-type: text/plain;charset=iso-8859-";

include('config.php');

	if(isset($_GET['print_id'])){
		$work_order_id = $_GET["print_id"];
	}else{
		exit;
	}


	$sql = mysqli_query($mysqli,"SELECT * FROM customers, work_orders, users 
		WHERE customers.customer_id = work_orders.customer_id 
		AND work_orders.take_in_employee = users.user_id 
		AND work_order_id = '$work_order_id'
	");

	$row = mysqli_fetch_array($sql);

		$first_name = $row['first_name'];
		$last_name = $row['last_name'];
		


$labelpc = "<?xml version=\"1.0\" encoding=\"utf-8\"?>
<DieCutLabel Version=\"8.0\" Units=\"twips\">
	<PaperOrientation>Landscape</PaperOrientation>
	<Id>Address</Id>
	<PaperName>30252 Address</PaperName>
	<DrawCommands>
		<RoundRectangle X=\"0\" Y=\"0\" Width=\"1581\" Height=\"5040\" Rx=\"270\" Ry=\"270\" />
	</DrawCommands>
	<ObjectInfo>
		<AddressObject>
			<Name>Address</Name>
			<ForeColor Alpha=\"255\" Red=\"0\" Green=\"0\" Blue=\"0\" />
			<BackColor Alpha=\"0\" Red=\"255\" Green=\"255\" Blue=\"255\" />
			<LinkedObjectName></LinkedObjectName>
			<Rotation>Rotation0</Rotation>
			<IsMirrored>False</IsMirrored>
			<IsVariable>True</IsVariable>
			<HorizontalAlignment>Center</HorizontalAlignment>
			<VerticalAlignment>Middle</VerticalAlignment>
			<TextFitMode>ShrinkToFit</TextFitMode>
			<UseFullFontHeight>True</UseFullFontHeight>
			<Verticalized>False</Verticalized>
			<StyledText>
				<Element>
					<String>Rudolf Swartenegarfg
8-16-2016</String>
					<Attributes>
						<Font Family=\"Arial\" Size=\"14\" Bold=\"False\" Italic=\"False\" Underline=\"False\" Strikeout=\"False\" />
						<ForeColor Alpha=\"255\" Red=\"0\" Green=\"0\" Blue=\"0\" />
					</Attributes>
				</Element>
			</StyledText>
			<ShowBarcodeFor9DigitZipOnly>False</ShowBarcodeFor9DigitZipOnly>
			<BarcodePosition>AboveAddress</BarcodePosition>
			<LineFonts>
				<Font Family=\"Arial\" Size=\"14\" Bold=\"False\" Italic=\"False\" Underline=\"False\" Strikeout=\"False\" />
				<Font Family=\"Arial\" Size=\"14\" Bold=\"False\" Italic=\"False\" Underline=\"False\" Strikeout=\"False\" />
			</LineFonts>
		</AddressObject>
		<Bounds X=\"1832\" Y=\"135\" Width=\"3030\" Height=\"1283\" />
	</ObjectInfo>
	<ObjectInfo>
		<TextObject>
			<Name>TEXT</Name>
			<ForeColor Alpha=\"255\" Red=\"0\" Green=\"0\" Blue=\"0\" />
			<BackColor Alpha=\"0\" Red=\"255\" Green=\"255\" Blue=\"255\" />
			<LinkedObjectName></LinkedObjectName>
			<Rotation>Rotation0</Rotation>
			<IsMirrored>False</IsMirrored>
			<IsVariable>False</IsVariable>
			<HorizontalAlignment>Left</HorizontalAlignment>
			<VerticalAlignment>Middle</VerticalAlignment>
			<TextFitMode>ShrinkToFit</TextFitMode>
			<UseFullFontHeight>True</UseFullFontHeight>
			<Verticalized>False</Verticalized>
			<StyledText>
				<Element>
					<String>2048</String>
					<Attributes>
						<Font Family=\"Arial\" Size=\"36\" Bold=\"False\" Italic=\"False\" Underline=\"False\" Strikeout=\"False\" />
						<ForeColor Alpha=\"255\" Red=\"0\" Green=\"0\" Blue=\"0\" />
					</Attributes>
				</Element>
			</StyledText>
		</TextObject>
		<Bounds X=\"331\" Y=\"300\" Width=\"1365\" Height=\"855\" />
	</ObjectInfo>
	<ObjectInfo>
		<ShapeObject>
			<Name>SHAPE</Name>
			<ForeColor Alpha=\"255\" Red=\"0\" Green=\"0\" Blue=\"0\" />
			<BackColor Alpha=\"0\" Red=\"255\" Green=\"255\" Blue=\"255\" />
			<LinkedObjectName></LinkedObjectName>
			<Rotation>Rotation0</Rotation>
			<IsMirrored>False</IsMirrored>
			<IsVariable>False</IsVariable>
			<ShapeType>VerticalLine</ShapeType>
			<LineWidth>15</LineWidth>
			<LineAlignment>Center</LineAlignment>
			<FillColor Alpha=\"0\" Red=\"255\" Green=\"255\" Blue=\"255\" />
		</ShapeObject>
		<Bounds X=\"1786\" Y=\"435\" Width=\"15\" Height=\"720\" />
	</ObjectInfo>
</DieCutLabel>";



//$labelpc_arr = explode("ZZ", $labelpc);
//$labelpc_q = count($labelpc_arr) - 1;
echo $labelpc;
//echo "var labelcw ='";
//for  ($i=0; $i<($labelpc_q); $i++){
//print htmlspecialchars($labelpc_arr[$i]);
//echo ($labelpc_arr[$i]);
//echo "<br>";
//}

//echo "'";

?>
