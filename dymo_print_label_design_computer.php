<?php

header("Content-type:text/plain");
output: "Content-type: text/plain;charset=iso-8859-";

include('config.php');

$computer_id = $_GET["print_id"];
//$computer_id = 830;
$sql = mysqli_query($mysqli,"SELECT * FROM computers WHERE computer_id = '$computer_id'");
if ( mysqli_num_rows($sql) <> 0){

	while ($row = mysqli_fetch_array($sql)){

    $type=$row['type'];
	$make=$row['make'];
	$model=$row['model'];
	$os=$row['os'];
	$processor=$row['processor'];
	$memory=$row['memory'];
	$memory_type="";
	$hard_drive=$row['hard_drive'];
	$hard_drive_type="";
	$system_number=$row['system_number'];
	$price=$row['price'];

	$wireless ="yes";
	$firewire ="yes";
	$sd ="yes";
	$webcam = "no";
	$dualmonitor ="no";

	if ($memory >= 1000){$memory = ($memory[0])."GB RAM";}else {$memory = $memory."MB RAM";}
	//if ($optical_1 == "DVD"){$optical_1 = "DVD-ROM";}else if ($optical_1 == "CD"){$optical_1 = "CD-ROM";}

	$price = intval($price);
	$processor = $processor;




	$warrany = "90 Day";
	if (intval($price) >= 249){ $warrany= "1 Year";}else { $warranyy = $memory."90 Day";}

	}
}




$make_model = $make." ".$model;
//$processor = $processor." ".$processor_freq;
//$memory = $memory." ".$memory_type;
$hard_drive = $hard_drive."GB HDD";

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
			<TextFitMode>None</TextFitMode>
			<UseFullFontHeight>True</UseFullFontHeight>
			<Verticalized>False</Verticalized>
			<StyledText>
				<Element>
					<String>".$make_model."</String>
					<Attributes>
						<Font Family=\"Arial\" Size=\"12\" Bold=\"True\" Italic=\"False\" Underline=\"False\" Strikeout=\"False\" />
						<ForeColor Alpha=\"255\" Red=\"0\" Green=\"0\" Blue=\"0\" />
					</Attributes>
				</Element>
			</StyledText>
			<ShowBarcodeFor9DigitZipOnly>False</ShowBarcodeFor9DigitZipOnly>
			<BarcodePosition>AboveAddress</BarcodePosition>
			<LineFonts>
				<Font Family=\"Arial\" Size=\"12\" Bold=\"True\" Italic=\"False\" Underline=\"False\" Strikeout=\"False\" />
			</LineFonts>
		</AddressObject>
		<Bounds X=\"2012\" Y=\"150\" Width=\"2895\" Height=\"278\" />
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
			<VerticalAlignment>Top</VerticalAlignment>
			<TextFitMode>ShrinkToFit</TextFitMode>
			<UseFullFontHeight>True</UseFullFontHeight>
			<Verticalized>False</Verticalized>
			<StyledText>
				<Element>
					<String>".$price."</String>
					<Attributes>
						<Font Family=\"Arial\" Size=\"36\" Bold=\"False\" Italic=\"False\" Underline=\"False\" Strikeout=\"False\" />
						<ForeColor Alpha=\"255\" Red=\"0\" Green=\"0\" Blue=\"0\" />
					</Attributes>
				</Element>
			</StyledText>
		</TextObject>
		<Bounds X=\"511\" Y=\"300\" Width=\"1080\" Height=\"750\" />
	</ObjectInfo>
	<ObjectInfo>
		<TextObject>
			<Name>TEXT_1</Name>
			<ForeColor Alpha=\"255\" Red=\"78\" Green=\"78\" Blue=\"78\" />
			<BackColor Alpha=\"0\" Red=\"255\" Green=\"255\" Blue=\"255\" />
			<LinkedObjectName></LinkedObjectName>
			<Rotation>Rotation0</Rotation>
			<IsMirrored>False</IsMirrored>
			<IsVariable>False</IsVariable>
			<HorizontalAlignment>Left</HorizontalAlignment>
			<VerticalAlignment>Top</VerticalAlignment>
			<TextFitMode>ShrinkToFit</TextFitMode>
			<UseFullFontHeight>True</UseFullFontHeight>
			<Verticalized>False</Verticalized>
			<StyledText>
				<Element>
					<String>".$system_number."</String>
					<Attributes>
						<Font Family=\"Arial\" Size=\"7\" Bold=\"False\" Italic=\"False\" Underline=\"False\" Strikeout=\"False\" />
						<ForeColor Alpha=\"255\" Red=\"78\" Green=\"78\" Blue=\"78\" />
					</Attributes>
				</Element>
			</StyledText>
		</TextObject>
		<Bounds X=\"1546\" Y=\"1298\" Width=\"692.000000000001\" Height=\"195\" />
	</ObjectInfo>
	<ObjectInfo>
		<TextObject>
			<Name>TEXT_2</Name>
			<ForeColor Alpha=\"255\" Red=\"0\" Green=\"0\" Blue=\"0\" />
			<BackColor Alpha=\"0\" Red=\"255\" Green=\"255\" Blue=\"255\" />
			<LinkedObjectName></LinkedObjectName>
			<Rotation>Rotation0</Rotation>
			<IsMirrored>False</IsMirrored>
			<IsVariable>False</IsVariable>
			<HorizontalAlignment>Left</HorizontalAlignment>
			<VerticalAlignment>Top</VerticalAlignment>
			<TextFitMode>ShrinkToFit</TextFitMode>
			<UseFullFontHeight>True</UseFullFontHeight>
			<Verticalized>False</Verticalized>
			<StyledText>
				<Element>
					<String>.99</String>
					<Attributes>
						<Font Family=\"Arial\" Size=\"10\" Bold=\"False\" Italic=\"False\" Underline=\"False\" Strikeout=\"False\" />
						<ForeColor Alpha=\"255\" Red=\"0\" Green=\"0\" Blue=\"0\" />
					</Attributes>
				</Element>
			</StyledText>
		</TextObject>
		<Bounds X=\"1620\" Y=\"465\" Width=\"315\" Height=\"270\" />
	</ObjectInfo>
	<ObjectInfo>
		<TextObject>
			<Name>TEXT__1</Name>
			<ForeColor Alpha=\"255\" Red=\"0\" Green=\"0\" Blue=\"0\" />
			<BackColor Alpha=\"0\" Red=\"255\" Green=\"255\" Blue=\"255\" />
			<LinkedObjectName></LinkedObjectName>
			<Rotation>Rotation0</Rotation>
			<IsMirrored>False</IsMirrored>
			<IsVariable>False</IsVariable>
			<HorizontalAlignment>Left</HorizontalAlignment>
			<VerticalAlignment>Top</VerticalAlignment>
			<TextFitMode>ShrinkToFit</TextFitMode>
			<UseFullFontHeight>True</UseFullFontHeight>
			<Verticalized>False</Verticalized>
			<StyledText>
				<Element>
					<String>$</String>
					<Attributes>
						<Font Family=\"Arial\" Size=\"16\" Bold=\"False\" Italic=\"False\" Underline=\"False\" Strikeout=\"False\" />
						<ForeColor Alpha=\"255\" Red=\"0\" Green=\"0\" Blue=\"0\" />
					</Attributes>
				</Element>
			</StyledText>
		</TextObject>
		<Bounds X=\"331\" Y=\"405\" Width=\"180\" Height=\"390\" />
	</ObjectInfo>
	<ObjectInfo>
		<ShapeObject>
			<Name>SHAPE</Name>
			<ForeColor Alpha=\"255\" Red=\"78\" Green=\"78\" Blue=\"78\" />
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
		<Bounds X=\"1996\" Y=\"255\" Width=\"15\" Height=\"765\" />
	</ObjectInfo>
	<ObjectInfo>
		<TextObject>
			<Name>TEXT_3</Name>
			<ForeColor Alpha=\"255\" Red=\"0\" Green=\"0\" Blue=\"0\" />
			<BackColor Alpha=\"0\" Red=\"255\" Green=\"255\" Blue=\"255\" />
			<LinkedObjectName></LinkedObjectName>
			<Rotation>Rotation0</Rotation>
			<IsMirrored>False</IsMirrored>
			<IsVariable>False</IsVariable>
			<HorizontalAlignment>Left</HorizontalAlignment>
			<VerticalAlignment>Top</VerticalAlignment>
			<TextFitMode>ShrinkToFit</TextFitMode>
			<UseFullFontHeight>True</UseFullFontHeight>
			<Verticalized>False</Verticalized>
			<StyledText>
				<Element>
					<String>+Tax</String>
					<Attributes>
						<Font Family=\"Arial\" Size=\"8\" Bold=\"False\" Italic=\"False\" Underline=\"False\" Strikeout=\"False\" />
						<ForeColor Alpha=\"255\" Red=\"0\" Green=\"0\" Blue=\"0\" />
					</Attributes>
				</Element>
			</StyledText>
		</TextObject>
		<Bounds X=\"1593\" Y=\"675\" Width=\"315\" Height=\"210\" />
	</ObjectInfo>
	<ObjectInfo>
		<ShapeObject>
			<Name>SHAPE_1</Name>
			<ForeColor Alpha=\"255\" Red=\"78\" Green=\"78\" Blue=\"78\" />
			<BackColor Alpha=\"0\" Red=\"255\" Green=\"255\" Blue=\"255\" />
			<LinkedObjectName></LinkedObjectName>
			<Rotation>Rotation0</Rotation>
			<IsMirrored>False</IsMirrored>
			<IsVariable>False</IsVariable>
			<ShapeType>HorizontalLine</ShapeType>
			<LineWidth>15</LineWidth>
			<LineAlignment>Center</LineAlignment>
			<FillColor Alpha=\"0\" Red=\"255\" Green=\"255\" Blue=\"255\" />
		</ShapeObject>
		<Bounds X=\"885.999999999999\" Y=\"1245\" Width=\"3330\" Height=\"15\" />
	</ObjectInfo>
	<ObjectInfo>
		<TextObject>
			<Name>TEXT_4</Name>
			<ForeColor Alpha=\"255\" Red=\"0\" Green=\"0\" Blue=\"0\" />
			<BackColor Alpha=\"0\" Red=\"255\" Green=\"255\" Blue=\"255\" />
			<LinkedObjectName></LinkedObjectName>
			<Rotation>Rotation0</Rotation>
			<IsMirrored>False</IsMirrored>
			<IsVariable>False</IsVariable>
			<HorizontalAlignment>Left</HorizontalAlignment>
			<VerticalAlignment>Top</VerticalAlignment>
			<TextFitMode>None</TextFitMode>
			<UseFullFontHeight>True</UseFullFontHeight>
			<Verticalized>False</Verticalized>
			<StyledText>
				<Element>
					<String>".$memory." ".$memory_type."| ".$hard_drive." ".$hard_drive_type."</String>
					<Attributes>
						<Font Family=\"Arial\" Size=\"9\" Bold=\"False\" Italic=\"False\" Underline=\"False\" Strikeout=\"False\" />
						<ForeColor Alpha=\"255\" Red=\"0\" Green=\"0\" Blue=\"0\" />
					</Attributes>
				</Element>
			</StyledText>
		</TextObject>
		<Bounds X=\"2298\" Y=\"690\" Width=\"2655\" Height=\"210\" />
	</ObjectInfo>
	<ObjectInfo>
		<TextObject>
			<Name>TEXT__2</Name>
			<ForeColor Alpha=\"255\" Red=\"0\" Green=\"0\" Blue=\"0\" />
			<BackColor Alpha=\"0\" Red=\"255\" Green=\"255\" Blue=\"255\" />
			<LinkedObjectName></LinkedObjectName>
			<Rotation>Rotation0</Rotation>
			<IsMirrored>False</IsMirrored>
			<IsVariable>False</IsVariable>
			<HorizontalAlignment>Left</HorizontalAlignment>
			<VerticalAlignment>Top</VerticalAlignment>
			<TextFitMode>ShrinkToFit</TextFitMode>
			<UseFullFontHeight>True</UseFullFontHeight>
			<Verticalized>False</Verticalized>
			<StyledText>
				<Element>
					<String>".$os."</String>
					<Attributes>
						<Font Family=\"Arial\" Size=\"9\" Bold=\"False\" Italic=\"False\" Underline=\"False\" Strikeout=\"False\" />
						<ForeColor Alpha=\"255\" Red=\"0\" Green=\"0\" Blue=\"0\" />
					</Attributes>
				</Element>
			</StyledText>
		</TextObject>
		<Bounds X=\"2298\" Y=\"930\" Width=\"2640\" Height=\"210\" />
	</ObjectInfo>
	<ObjectInfo>
		<TextObject>
			<Name>TEXT_5</Name>
			<ForeColor Alpha=\"255\" Red=\"0\" Green=\"0\" Blue=\"0\" />
			<BackColor Alpha=\"0\" Red=\"255\" Green=\"255\" Blue=\"255\" />
			<LinkedObjectName></LinkedObjectName>
			<Rotation>Rotation0</Rotation>
			<IsMirrored>False</IsMirrored>
			<IsVariable>False</IsVariable>
			<HorizontalAlignment>Left</HorizontalAlignment>
			<VerticalAlignment>Top</VerticalAlignment>
			<TextFitMode>ShrinkToFit</TextFitMode>
			<UseFullFontHeight>True</UseFullFontHeight>
			<Verticalized>False</Verticalized>
			<StyledText>
				<Element>
					<String>SN:</String>
					<Attributes>
						<Font Family=\"Arial\" Size=\"7\" Bold=\"False\" Italic=\"False\" Underline=\"False\" Strikeout=\"False\" />
						<ForeColor Alpha=\"255\" Red=\"0\" Green=\"0\" Blue=\"0\" />
					</Attributes>
				</Element>
			</StyledText>
		</TextObject>
		<Bounds X=\"1216\" Y=\"1298\" Width=\"330\" Height=\"195\" />
	</ObjectInfo>
	<ObjectInfo>
		<ShapeObject>
			<Name>SHAPE_2</Name>
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
		<Bounds X=\"2355\" Y=\"1313\" Width=\"15\" Height=\"120\" />
	</ObjectInfo>
	<ObjectInfo>
		<TextObject>
			<Name>TEXT__3</Name>
			<ForeColor Alpha=\"255\" Red=\"78\" Green=\"78\" Blue=\"78\" />
			<BackColor Alpha=\"0\" Red=\"255\" Green=\"255\" Blue=\"255\" />
			<LinkedObjectName></LinkedObjectName>
			<Rotation>Rotation0</Rotation>
			<IsMirrored>False</IsMirrored>
			<IsVariable>False</IsVariable>
			<HorizontalAlignment>Left</HorizontalAlignment>
			<VerticalAlignment>Top</VerticalAlignment>
			<TextFitMode>ShrinkToFit</TextFitMode>
			<UseFullFontHeight>True</UseFullFontHeight>
			<Verticalized>False</Verticalized>
			<StyledText>
				<Element>
					<String>".$warrany."</String>
					<Attributes>
						<Font Family=\"Arial\" Size=\"7\" Bold=\"False\" Italic=\"False\" Underline=\"False\" Strikeout=\"False\" />
						<ForeColor Alpha=\"255\" Red=\"78\" Green=\"78\" Blue=\"78\" />
					</Attributes>
				</Element>
			</StyledText>
		</TextObject>
		<Bounds X=\"3361\" Y=\"1298\" Width=\"1082\" Height=\"195\" />
	</ObjectInfo>
	<ObjectInfo>
		<TextObject>
			<Name>TEXT__4</Name>
			<ForeColor Alpha=\"255\" Red=\"0\" Green=\"0\" Blue=\"0\" />
			<BackColor Alpha=\"0\" Red=\"255\" Green=\"255\" Blue=\"255\" />
			<LinkedObjectName></LinkedObjectName>
			<Rotation>Rotation0</Rotation>
			<IsMirrored>False</IsMirrored>
			<IsVariable>False</IsVariable>
			<HorizontalAlignment>Left</HorizontalAlignment>
			<VerticalAlignment>Top</VerticalAlignment>
			<TextFitMode>ShrinkToFit</TextFitMode>
			<UseFullFontHeight>True</UseFullFontHeight>
			<Verticalized>False</Verticalized>
			<StyledText>
				<Element>
					<String>Warranty:</String>
					<Attributes>
						<Font Family=\"Arial\" Size=\"7\" Bold=\"False\" Italic=\"False\" Underline=\"False\" Strikeout=\"False\" />
						<ForeColor Alpha=\"255\" Red=\"0\" Green=\"0\" Blue=\"0\" />
					</Attributes>
				</Element>
			</StyledText>
		</TextObject>
		<Bounds X=\"2611\" Y=\"1298\" Width=\"720\" Height=\"195\" />
	</ObjectInfo>
	<ObjectInfo>
		<TextObject>
			<Name>TEXT__5</Name>
			<ForeColor Alpha=\"255\" Red=\"0\" Green=\"0\" Blue=\"0\" />
			<BackColor Alpha=\"0\" Red=\"255\" Green=\"255\" Blue=\"255\" />
			<LinkedObjectName></LinkedObjectName>
			<Rotation>Rotation0</Rotation>
			<IsMirrored>False</IsMirrored>
			<IsVariable>False</IsVariable>
			<HorizontalAlignment>Left</HorizontalAlignment>
			<VerticalAlignment>Top</VerticalAlignment>
			<TextFitMode>None</TextFitMode>
			<UseFullFontHeight>True</UseFullFontHeight>
			<Verticalized>False</Verticalized>
			<StyledText>
				<Element>
					<String>".$processor."</String>
					<Attributes>
						<Font Family=\"Arial\" Size=\"9\" Bold=\"False\" Italic=\"False\" Underline=\"False\" Strikeout=\"False\" />
						<ForeColor Alpha=\"255\" Red=\"0\" Green=\"0\" Blue=\"0\" />
					</Attributes>
				</Element>
			</StyledText>
		</TextObject>
		<Bounds X=\"2298\" Y=\"450\" Width=\"2655\" Height=\"210\" />
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
