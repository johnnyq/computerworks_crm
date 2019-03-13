<?php

header("Content-type:text/plain");
output: "Content-type: text/plain;charset=iso-8859-";

include('config.php');

$customer_id = $_GET["print_id"];
 
$sql = mysqli_query($mysqli,"SELECT * from customers WHERE customer_id = $customer_id");

	$row = mysqli_fetch_array($sql);
	
	$company = $row['company'];
    $first_name = ucwords($row['first_name']);
    $last_name = ucwords($row['last_name']);
    $address = ucwords($row['address']);
    $city = $row['city'];
    $state = $row['state'];
    $zip = $row['zip'];
    $phone = $row['phone'];
    if(strlen($phone)>2){ $phone = substr($row['phone'],0,3)."-".substr($row['phone'],3,3)."-".substr($row['phone'],6,4);}
    $mobile = $row['mobile'];
    if(strlen($mobile)>2){ $mobile = substr($row['mobile'],0,3)."-".substr($row['mobile'],3,3)."-".substr($row['mobile'],6,4);}
    $email = $row['email'];
    $date_added = date($date_format,$row['date_added']);





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
			<HorizontalAlignment>Left</HorizontalAlignment>
			<VerticalAlignment>Middle</VerticalAlignment>
			<TextFitMode>None</TextFitMode>
			<UseFullFontHeight>True</UseFullFontHeight>
			<Verticalized>False</Verticalized>
			<StyledText>
				<Element>
					<String>$first_name $last_name</String>
					<Attributes>
						<Font Family=\"Garamond\" Size=\"16\" Bold=\"True\" Italic=\"False\" Underline=\"False\" Strikeout=\"False\" />
						<ForeColor Alpha=\"255\" Red=\"0\" Green=\"0\" Blue=\"0\" />
					</Attributes>
				</Element>
			</StyledText>
			<ShowBarcodeFor9DigitZipOnly>False</ShowBarcodeFor9DigitZipOnly>
			<BarcodePosition>AboveAddress</BarcodePosition>
			<LineFonts>
				<Font Family=\"Garamond\" Size=\"16\" Bold=\"True\" Italic=\"False\" Underline=\"False\" Strikeout=\"False\" />
			</LineFonts>
		</AddressObject>
		<Bounds X=\"857\" Y=\"300\" Width=\"4096\" Height=\"398\" />
	</ObjectInfo>
	<ObjectInfo>
		<AddressObject>
			<Name>Address_1</Name>
			<ForeColor Alpha=\"255\" Red=\"0\" Green=\"0\" Blue=\"0\" />
			<BackColor Alpha=\"0\" Red=\"255\" Green=\"255\" Blue=\"255\" />
			<LinkedObjectName></LinkedObjectName>
			<Rotation>Rotation0</Rotation>
			<IsMirrored>False</IsMirrored>
			<IsVariable>True</IsVariable>
			<HorizontalAlignment>Left</HorizontalAlignment>
			<VerticalAlignment>Middle</VerticalAlignment>
			<TextFitMode>None</TextFitMode>
			<UseFullFontHeight>True</UseFullFontHeight>
			<Verticalized>False</Verticalized>
			<StyledText>
				<Element>
					<String>$address.</String>
					<Attributes>
						<Font Family=\"Garamond\" Size=\"14\" Bold=\"False\" Italic=\"False\" Underline=\"False\" Strikeout=\"False\" />
						<ForeColor Alpha=\"255\" Red=\"0\" Green=\"0\" Blue=\"0\" />
					</Attributes>
				</Element>
			</StyledText>
			<ShowBarcodeFor9DigitZipOnly>False</ShowBarcodeFor9DigitZipOnly>
			<BarcodePosition>AboveAddress</BarcodePosition>
			<LineFonts>
				<Font Family=\"Arial\" Size=\"14\" Bold=\"False\" Italic=\"False\" Underline=\"False\" Strikeout=\"False\" />
			</LineFonts>
		</AddressObject>
		<Bounds X=\"842\" Y=\"690\" Width=\"4081\" Height=\"353\" />
	</ObjectInfo>
	<ObjectInfo>
		<AddressObject>
			<Name>Address__1</Name>
			<ForeColor Alpha=\"255\" Red=\"0\" Green=\"0\" Blue=\"0\" />
			<BackColor Alpha=\"0\" Red=\"255\" Green=\"255\" Blue=\"255\" />
			<LinkedObjectName></LinkedObjectName>
			<Rotation>Rotation0</Rotation>
			<IsMirrored>False</IsMirrored>
			<IsVariable>True</IsVariable>
			<HorizontalAlignment>Left</HorizontalAlignment>
			<VerticalAlignment>Middle</VerticalAlignment>
			<TextFitMode>None</TextFitMode>
			<UseFullFontHeight>True</UseFullFontHeight>
			<Verticalized>False</Verticalized>
			<StyledText>
				<Element>
					<String>$city, $state</String>
					<Attributes>
						<Font Family=\"Garamond\" Size=\"14\" Bold=\"False\" Italic=\"False\" Underline=\"False\" Strikeout=\"False\" />
						<ForeColor Alpha=\"255\" Red=\"0\" Green=\"0\" Blue=\"0\" />
					</Attributes>
				</Element>
			</StyledText>
			<ShowBarcodeFor9DigitZipOnly>False</ShowBarcodeFor9DigitZipOnly>
			<BarcodePosition>AboveAddress</BarcodePosition>
			<LineFonts>
				<Font Family=\"Arial\" Size=\"12\" Bold=\"False\" Italic=\"False\" Underline=\"False\" Strikeout=\"False\" />
			</LineFonts>
		</AddressObject>
		<Bounds X=\"856\" Y=\"1005\" Width=\"2926\" Height=\"368\" />
	</ObjectInfo>
	<ObjectInfo>
		<AddressObject>
			<Name>Address___1</Name>
			<ForeColor Alpha=\"255\" Red=\"0\" Green=\"0\" Blue=\"0\" />
			<BackColor Alpha=\"0\" Red=\"255\" Green=\"255\" Blue=\"255\" />
			<LinkedObjectName></LinkedObjectName>
			<Rotation>Rotation0</Rotation>
			<IsMirrored>False</IsMirrored>
			<IsVariable>True</IsVariable>
			<HorizontalAlignment>Right</HorizontalAlignment>
			<VerticalAlignment>Middle</VerticalAlignment>
			<TextFitMode>None</TextFitMode>
			<UseFullFontHeight>True</UseFullFontHeight>
			<Verticalized>False</Verticalized>
			<StyledText>
				<Element>
					<String>$zip</String>
					<Attributes>
						<Font Family=\"Garamond\" Size=\"14\" Bold=\"False\" Italic=\"False\" Underline=\"False\" Strikeout=\"False\" />
						<ForeColor Alpha=\"255\" Red=\"0\" Green=\"0\" Blue=\"0\" />
					</Attributes>
				</Element>
			</StyledText>
			<ShowBarcodeFor9DigitZipOnly>False</ShowBarcodeFor9DigitZipOnly>
			<BarcodePosition>AboveAddress</BarcodePosition>
			<LineFonts>
				<Font Family=\"Garamond\" Size=\"14\" Bold=\"False\" Italic=\"False\" Underline=\"False\" Strikeout=\"False\" />
			</LineFonts>
		</AddressObject>
		<Bounds X=\"3841\" Y=\"1005\" Width=\"721.999999999998\" Height=\"398\" />
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
