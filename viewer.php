

<?php session_start();  ?>
<?php include 'header.php';?>
<?php include '../../connection.php';?>
<?php
  	$userempcode = $_SESSION['empcode'];
			if($userempcode != true){
				header('Location:../../login.php');
		} 
 ?>
 <?php 
 $uploadMsg = '';
  if(isset($_POST['submit'])){
	$name       = $_FILES['file']['name'];  
	$temp_name  = $_FILES['file']['tmp_name'];  
	if(isset($name)){
		if(!empty($name)){   	
			$location = 'uploads/';   
			if (($_FILES["file"]["type"] == "application/pdf"))
			{
				if(move_uploaded_file($temp_name, $location.$name)){
					/* $sql = "INSERT INTO files (pdf_filename)VALUES ('".$name."')";
					if ($conn->query($sql) === TRUE) {
						echo "insert";
					}	 */
				//echo '$sql';
				//die('tesets');
					//echo 'File uploaded successfully';
					   echo "
						<script type=\"text/javascript\">
							window.location.href='?file=uploads/".$_FILES["file"]["name"]."';
						</script>
					"; 
				}
			}else{
				$uploadMsg = "Please upload PDF File";
			}
		}       
	}  else {
		echo 'You should select a file to upload !!';
	}
}
?>
<!DOCTYPE html>
<html dir="ltr" mozdisallowselectionprint>
  <head>
  <style>
  .form-control:focus {
  border: 3px solid #66afe9 !important;
}
th, td {
    padding: 2px !important;
}
.view_pdf{
    cursor: pointer !important;
}
  </style>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
		<meta name="google" content="notranslate">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<title>PDF.js viewer</title>
		<link rel="stylesheet" href="viewer.css">
		<!--bootstrap-->
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="stylesheet" href="assets/css/bootstrap.min.css">
		<script src="assets/js/jquery.js"></script>
		<!--<link href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">-->
	
	<!-- This snippet is used in production (included from viewer.html) -->
		<link rel="resource" type="application/l10n" href="locale/locale.properties">
		<script src="../build/pdf.js"></script>
		<script src="viewer.js"></script>
		<script src="jquery.selection.js"></script>
	<!--form validation-->
		<!--<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">-->
		<link rel="stylesheet" href="assets/css/bootstrap-theme.min.css">
		<script src="assets/js/underscore-min.js"></script>
		<script src="assets/js/moment.min.js"></script>
		<script src="assets/js/jquery.validate.min.js"></script>
		

	<!--context menu with submenu-->
		<link rel="stylesheet" href="assets/css/font-awesome.min.css">
		
  </head>
  <body tabindex="1" class="loadingInProgress hold-transition skin-blue sidebar-mini">
  
    <div id="outerContainer">
		<div class="file-success-msg hide" style="width: 550px;height: auto;display:block;position:fixed; z-index: 100;top: 43px;margin-left: 20px;text-align:center;margin-top:100px;">
			<span class="alert alert-success" id="success-alert">File created successfully.</span>
		</div>
      <div id="sidebarContainer">
        <div id="toolbarSidebar">
          <div class="splitToolbarButton toggled">
            <button id="viewThumbnail" class="toolbarButton toggled" title="Show Thumbnails" tabindex="2" data-l10n-id="thumbs">
               <span data-l10n-id="thumbs_label">Thumbnails</span>
            </button>
            <button id="viewOutline" class="toolbarButton" title="Show Document Outline (double-click to expand/collapse all items)" tabindex="3" data-l10n-id="document_outline">
               <span data-l10n-id="document_outline_label">Document Outline</span>
            </button>
            <button id="viewAttachments" class="toolbarButton" title="Show Attachments" tabindex="4" data-l10n-id="attachments">
               <span data-l10n-id="attachments_label">Attachments</span>
            </button>
          </div>
        </div>
        <div id="sidebarContent">
          <div id="thumbnailView" style="display:none;">
          </div>
          <div id="outlineView" class="hidden">
          </div>
          <div id="attachmentsView" class="hidden">
          </div>
        </div>
        <div id="sidebarResizer" class="hidden"></div>
		 
      </div>  <!-- sidebarContainer -->
      <div id="mainContainer">
        <div class="findbar hidden doorHanger" id="findbar">
          <div id="findbarInputContainer">
            <input id="findInput" class="toolbarField" title="Find" placeholder="Find in document…" tabindex="91" data-l10n-id="find_input">
            <div class="splitToolbarButton">
              <button id="findPrevious" class="toolbarButton findPrevious" title="Find the previous occurrence of the phrase" tabindex="92" data-l10n-id="find_previous">
                <span data-l10n-id="find_previous_label">Previous</span>
              </button>
              <div class="splitToolbarButtonSeparator"></div>
              <button id="findNext" class="toolbarButton findNext" title="Find the next occurrence of the phrase" tabindex="93" data-l10n-id="find_next">
                <span data-l10n-id="find_next_label">Next</span>
              </button>
            </div>
          </div>

          <div id="findbarOptionsOneContainer">
            <input type="checkbox" id="findHighlightAll" class="toolbarField" tabindex="94">
            <label for="findHighlightAll" class="toolbarLabel" data-l10n-id="find_highlight">Highlight all</label>
            <input type="checkbox" id="findMatchCase" class="toolbarField" tabindex="95">
            <label for="findMatchCase" class="toolbarLabel" data-l10n-id="find_match_case_label">Match case</label>
          </div>
          <div id="findbarOptionsTwoContainer">
            <input type="checkbox" id="findEntireWord" class="toolbarField" tabindex="96">
            <label for="findEntireWord" class="toolbarLabel" data-l10n-id="find_entire_word_label">Whole words</label>
            <span id="findResultsCount" class="toolbarLabel hidden"></span>
          </div>

          <div id="findbarMessageContainer">
            <span id="findMsg" class="toolbarLabel"></span>
          </div>
        </div>  <!-- findbar -->

        <div id="secondaryToolbar" class="secondaryToolbar hidden doorHangerRight">
          <div id="secondaryToolbarButtonContainer">
            <button id="secondaryPresentationMode" class="secondaryToolbarButton presentationMode visibleLargeView" title="Switch to Presentation Mode" tabindex="51" data-l10n-id="presentation_mode">
              <span data-l10n-id="presentation_mode_label">Presentation Mode</span>
            </button>

            <button id="secondaryOpenFile" class="secondaryToolbarButton openFile visibleLargeView" title="Open File" tabindex="52" data-l10n-id="open_file">
              <span data-l10n-id="open_file_label">Open</span>
            </button>

            <button id="secondaryPrint" class="secondaryToolbarButton print visibleMediumView" title="Print" tabindex="53" data-l10n-id="print">
              <span data-l10n-id="print_label">Print</span>
            </button>

            <button id="secondaryDownload" class="secondaryToolbarButton download visibleMediumView" title="Download" tabindex="54" data-l10n-id="download">
              <span data-l10n-id="download_label">Download</span>
            </button>

            <a href="#" id="secondaryViewBookmark" class="secondaryToolbarButton bookmark visibleSmallView" title="Current view (copy or open in new window)" tabindex="55" data-l10n-id="bookmark">
              <span data-l10n-id="bookmark_label">Current View</span>
            </a>

            <div class="horizontalToolbarSeparator visibleLargeView"></div>

            <button id="firstPage" class="secondaryToolbarButton firstPage" title="Go to First Page" tabindex="56" data-l10n-id="first_page">
              <span data-l10n-id="first_page_label">Go to First Page</span>
            </button>
            <button id="lastPage" class="secondaryToolbarButton lastPage" title="Go to Last Page" tabindex="57" data-l10n-id="last_page">
              <span data-l10n-id="last_page_label">Go to Last Page</span>
            </button>

            <div class="horizontalToolbarSeparator"></div>

            <button id="pageRotateCw" class="secondaryToolbarButton rotateCw" title="Rotate Clockwise" tabindex="58" data-l10n-id="page_rotate_cw">
              <span data-l10n-id="page_rotate_cw_label">Rotate Clockwise</span>
            </button>
            <button id="pageRotateCcw" class="secondaryToolbarButton rotateCcw" title="Rotate Counterclockwise" tabindex="59" data-l10n-id="page_rotate_ccw">
              <span data-l10n-id="page_rotate_ccw_label">Rotate Counterclockwise</span>
            </button>

            <div class="horizontalToolbarSeparator"></div>

            <button id="cursorSelectTool" class="secondaryToolbarButton selectTool toggled" title="Enable Text Selection Tool" tabindex="60" data-l10n-id="cursor_text_select_tool">
              <span data-l10n-id="cursor_text_select_tool_label">Text Selection Tool</span>
            </button>
            <button id="cursorHandTool" class="secondaryToolbarButton handTool" title="Enable Hand Tool" tabindex="61" data-l10n-id="cursor_hand_tool">
              <span data-l10n-id="cursor_hand_tool_label">Hand Tool</span>
            </button>

            <div class="horizontalToolbarSeparator"></div>

            <button id="scrollVertical" class="secondaryToolbarButton scrollModeButtons scrollVertical toggled" title="Use Vertical Scrolling" tabindex="62" data-l10n-id="scroll_vertical">
              <span data-l10n-id="scroll_vertical_label">Vertical Scrolling</span>
            </button>
            <button id="scrollHorizontal" class="secondaryToolbarButton scrollModeButtons scrollHorizontal" title="Use Horizontal Scrolling" tabindex="63" data-l10n-id="scroll_horizontal">
              <span data-l10n-id="scroll_horizontal_label">Horizontal Scrolling</span>
            </button>
            <button id="scrollWrapped" class="secondaryToolbarButton scrollModeButtons scrollWrapped" title="Use Wrapped Scrolling" tabindex="64" data-l10n-id="scroll_wrapped">
              <span data-l10n-id="scroll_wrapped_label">Wrapped Scrolling</span>
            </button>

            <div class="horizontalToolbarSeparator scrollModeButtons"></div>

            <button id="spreadNone" class="secondaryToolbarButton spreadModeButtons spreadNone toggled" title="Do not join page spreads" tabindex="65" data-l10n-id="spread_none">
              <span data-l10n-id="spread_none_label">No Spreads</span>
            </button>
            <button id="spreadOdd" class="secondaryToolbarButton spreadModeButtons spreadOdd" title="Join page spreads starting with odd-numbered pages" tabindex="66" data-l10n-id="spread_odd">
              <span data-l10n-id="spread_odd_label">Odd Spreads</span>
            </button>
            <button id="spreadEven" class="secondaryToolbarButton spreadModeButtons spreadEven" title="Join page spreads starting with even-numbered pages" tabindex="67" data-l10n-id="spread_even">
              <span data-l10n-id="spread_even_label">Even Spreads</span>
            </button>

            <div class="horizontalToolbarSeparator spreadModeButtons"></div>

            <button id="documentProperties" class="secondaryToolbarButton documentProperties" title="Document Properties…" tabindex="68" data-l10n-id="document_properties">
              <span data-l10n-id="document_properties_label">Document Properties…</span>
            </button>
          </div>
        </div>  <!-- secondaryToolbar -->

        <div class="toolbar">
          <div id="toolbarContainer">
            <div id="toolbarViewer">
              <div id="toolbarViewerLeft">
                <button id="sidebarToggle" class="toolbarButton" title="Toggle Sidebar" tabindex="11" data-l10n-id="toggle_sidebar">
                  <span data-l10n-id="toggle_sidebar_label">Toggle Sidebar</span>
                </button>
                <div class="toolbarButtonSpacer"></div>
                <button id="viewFind" class="toolbarButton" title="Find in Document" tabindex="12" data-l10n-id="findbar">
                  <span data-l10n-id="findbar_label">Find</span>
                </button>
                <div class="splitToolbarButton hiddenSmallView">
                  <button class="toolbarButton pageUp" title="Previous Page" id="previous" tabindex="13" data-l10n-id="previous">
                    <span data-l10n-id="previous_label">Previous</span>
                  </button>
                  <div class="splitToolbarButtonSeparator"></div>
                  <button class="toolbarButton pageDown" title="Next Page" id="next" tabindex="14" data-l10n-id="next">
                    <span data-l10n-id="next_label">Next</span>
                  </button>
                </div>
              </div>
              <div id="toolbarViewerRight">
			  <div style="display: none;">
					<button id="presentationMode" class="toolbarButton presentationMode hiddenLargeView" title="Switch to Presentation Mode" tabindex="31" data-l10n-id="presentation_mode">
					  <span data-l10n-id="presentation_mode_label">Presentation Mode</span>
					</button>

					<button id="openFile" class="toolbarButton openFile hiddenLargeView" title="Open File" tabindex="32" data-l10n-id="open_file">
					  <span data-l10n-id="open_file_label">Open</span>
					</button>

					<button id="print" class="toolbarButton print hiddenMediumView" title="Print" tabindex="33" data-l10n-id="print">
					  <span data-l10n-id="print_label">Print</span>
					</button>

					<button id="download" class="toolbarButton download hiddenMediumView" title="Download" tabindex="34" data-l10n-id="download">
					  <span data-l10n-id="download_label">Download</span>
					</button>
					<a href="#" id="viewBookmark" class="toolbarButton bookmark hiddenSmallView" title="Current view (copy or open in new window)" tabindex="35" data-l10n-id="bookmark">
					  <span data-l10n-id="bookmark_label">Current View</span>
					</a>

					<div class="verticalToolbarSeparator hiddenSmallView"></div>

				   <button style="display: none;" id="secondaryToolbarToggle" class="toolbarButton" title="Tools" tabindex="36" data-l10n-id="tools">
					  <span data-l10n-id="tools_label">Tools</span>
					</button> 
				
              </div>
			  <div class="filedownload hide" style="padding: 6px 17px 10px 10px; font-weight: bold; font-size: 13px; color: #fff;"></div>
			   <a href="<?php echo constant("BACKPDFLISTING");  ?>"><button style="padding-top: 0;" type="submit" class="btn btn-primary">View Articles List</button></a>
			  <div style="padding: 6px 17px 10px 10px; font-weight: bold; font-size: 13px;"><a style="color: #fff;" href="logout.php">Logout</a></div>
              </div>
              <div id="toolbarViewerMiddle">
				<!--<form action="" style="padding-top:5px;" method="post" enctype="multipart/form-data">
					<span style="float:left;"><input type="file" name="file" id="file" size="5"></span>
					<span><input type="submit" value="Upload"  name="submit"></span>
				</form>-->
				<!--<a href="http://st9.idsil.com/noidaChamp/pdfViewer/pdfjs/web/viewer.php"><button style="padding-top: 0;" type="submit" class="btn btn-primary">PDFListing</button></a>-->
				<!--<a href="?file=KP_sample_PDF.pdf"><input type="submit" value="Upload" name="submit"></a>-->
                <div class="splitToolbarButton">
                  <button id="zoomOut" class="toolbarButton zoomOut" title="Zoom Out" tabindex="21" data-l10n-id="zoom_out">
                    <span data-l10n-id="zoom_out_label">Zoom Out</span>
                  </button>
                  <div class="splitToolbarButtonSeparator"></div>
                  <button id="zoomIn" class="toolbarButton zoomIn" title="Zoom In" tabindex="22" data-l10n-id="zoom_in">
                    <span data-l10n-id="zoom_in_label">Zoom In</span>
                   </button>
                </div>
                <span id="scaleSelectContainer" class="dropdownToolbarButton">
                  <select id="scaleSelect" title="Zoom" tabindex="23" data-l10n-id="zoom">
                    <option id="pageAutoOption" title="" value="auto" selected="selected" data-l10n-id="page_scale_auto">Automatic Zoom</option>
                    <option id="pageActualOption" title="" value="page-actual" data-l10n-id="page_scale_actual">Actual Size</option>
                    <option id="pageFitOption" title="" value="page-fit" data-l10n-id="page_scale_fit">Page Fit</option>
                    <option id="pageWidthOption" title="" value="page-width" data-l10n-id="page_scale_width">Page Width</option>
                    <option id="customScaleOption" title="" value="custom" disabled="disabled" hidden="true"></option>
                    <option title="" value="0.5" data-l10n-id="page_scale_percent" data-l10n-args='{ "scale": 50 }'>50%</option>
                    <option title="" value="0.75" data-l10n-id="page_scale_percent" data-l10n-args='{ "scale": 75 }'>75%</option>
                    <option title="" value="1" data-l10n-id="page_scale_percent" data-l10n-args='{ "scale": 100 }'>100%</option>
                    <option title="" value="1.25" data-l10n-id="page_scale_percent" data-l10n-args='{ "scale": 125 }'>125%</option>
                    <option title="" value="1.5" data-l10n-id="page_scale_percent" data-l10n-args='{ "scale": 150 }'>150%</option>
                    <option title="" value="2" data-l10n-id="page_scale_percent" data-l10n-args='{ "scale": 200 }'>200%</option>
                    <option title="" value="3" data-l10n-id="page_scale_percent" data-l10n-args='{ "scale": 300 }'>300%</option>
                    <option title="" value="4" data-l10n-id="page_scale_percent" data-l10n-args='{ "scale": 400 }'>400%</option>
                  </select>
                </span>
				<input type="number" id="pageNumber" class="toolbarField pageNumber" title="Page" value="1" size="4" min="1" tabindex="15" data-l10n-id="page">
                <span id="numPages" class="toolbarLabel"></span>
				
              </div>
			  
            </div>
		    <div id="loadingBar">
              <div class="progress">
                <div class="glimmer">
                </div>
              </div>
            </div>
          </div>
        </div>

        <menu type="context" id="viewerContextMenu">
          <menuitem id="contextFirstPage" label="First Page"
                    data-l10n-id="first_page"></menuitem>
          <menuitem id="contextLastPage" label="Last Page"
                    data-l10n-id="last_page"></menuitem>
          <menuitem id="contextPageRotateCw" label="Rotate Clockwise"
                    data-l10n-id="page_rotate_cw"></menuitem>
          <menuitem id="contextPageRotateCcw" label="Rotate Counter-Clockwise"
                    data-l10n-id="page_rotate_ccw"></menuitem>
        </menu>
		
        <div id="viewerContainer" tabindex="0">
			<?php   if (strpos($_SERVER['REQUEST_URI'], "?file=uploads/") !== false) { 
					echo '<div id="fileuploadform" style="text-align: center;padding-top: 14%;display:none;"></div>';
				 }
				  else {  
					//echo ''; 
			?>
			<div class="wrapper">
				<div class="content-wrapper">
				<!-- Main content -->
					<section class="content">
					  <div class="row">
								<div class="col-md-12" style="padding-left: 17%;padding-right: 20%;top:28px;">
								  <div class="box">
									<div class="box-header">
									  <h3 class="box-title">File Listing</h3>
									</div>
									<!-- /.box-header -->
									<div class="box-body">
									  <table id="example1" class="table table-bordered table-striped">
									   <thead>
											<tr>
												<th>Sr.</th>
												<th>Filename</th>
												<th>Action</th>
											</tr>
										</thead>
										<tbody>
										<?php 
										//strrchr($string , ' ');
											$i =1;
												$foldername = $_SESSION['empname'].'_'.$_SESSION['empcode'];
												$dirName = "uploads/".$foldername;
												//echo $dirName;
												chdir($dirName);
												array_multisort(array_map('filemtime', ($files = glob("*.*"))), SORT_DESC, $files);
												//if(strrchr($filename , '.') == 'pdf'){
												foreach($files as $key=>$filename){
													if($key <= 9){
													$pdfFile = $dirName.'/'.$filename;
													$filename1 = strrchr($filename, ".");
													if($filename1 == '.pdf'){
													
										?>
										<tr>
											<td><?php echo $i; ?></td>
											<td><?php  echo $filename;   ?></td>
											<td><a class="view_pdf" onclick="openfilePdf('<?php echo $pdfFile;?>');">View PDF</a>
										</tr>
												<?php $i++;  } } } ?>
										</tbody> 
									  </table>
									  </div> 
								
						<!-- /.box-body -->
						  </div> 
					  <!-- /.box -->
					</div>
					<!-- /.col -->
				  </div>
				  <!-- /.row -->
				</section>
				<!-- /.content -->
			  </div>
			</div>
			
			<!--<div id="fileuploadform" style="text-align: center;padding-top: 14%;display:block;">
				<span style="font-size: 14px;font-weight: bold;"><?php //echo $uploadMsg; ?></span>
				<form action="" method="post" enctype="multipart/form-data">
						<div id="file-upload-filename"></div>
						<input type="file" name="file" id="file-1" class="inputfile inputfile-1" data-multiple-caption="{count} files selected" multiple="">
						<label for="file-1"><svg xmlns="#" width="20" height="17" viewBox="0 0 20 17">
							<path d="M10 0l-5.2 4.9h3.3v5.1h3.8v-5.1h3.3l-5.2-4.9zm9.3 11.5l-3.2-2.1h-2l3.4 2.6h-3.5c-.1 0-.2.1-.2.1l-.8 2.3h-6l-.8-2.2c-.1-.1-.1-.2-.2-.2h-3.6l3.4-2.6h-2l-3.2 2.1c-.4.3-.7 1-.6 1.5l.6 3.1c.1.5.7.9 1.2.9h16.3c.6 0 1.1-.4 1.3-.9l.6-3.1c.1-.5-.2-1.2-.7-1.5z"></path>
							</svg> <span>Choose a file…</span></label><br><br> 
					  <input class="btn btn-default" type="submit" value="Upload"  name="submit">
				</form> 
			</div>-->
			
			<?php 
				// echo'';
				}  
			?>
			
			<?php   
				$filename = basename($_SERVER['REQUEST_URI']);
				$arr = explode(".",  $filename, 2);
				$arr1 = explode("_",  $arr[0], 2);
				 
			?>
			
			<?php   
				$filename = basename($_SERVER['REQUEST_URI']);
				$arr = explode(".",  $filename, 2);
				$arr1 = explode("_",  $arr[0], 2);
				 
			?>
			<?php 
				 if (strpos($_SERVER['REQUEST_URI'], "?file=uploads/") !== false) { 
					//echo '<div id="userForm" style="position: fixed;top:-5px;padding-top: 46px;display:block;">';
				
			?>
		<div id="userForm" style="position:fixed;top:-5px;padding-top: 46px;display:block;float:left !important;">
			<div class="ScrollStyle">
				<form class="cmxform ettForm" id="signupForm" method="POST" action="" style="padding-top: 20px; padding-left:10px;"> 
					<fieldset>
						<legend style="width: 35% !important;">Magazine Information</legend>
							<div class="col-md-2 col-mid-2 no-padding-right">
								<div class="form-group">
									<label for="MID">MID</label>
									<input type="text" id="MID" class="form-control txt_mid keepValue" placeholder="MID" name="MID" value="<?php  echo $arr1[0]; //$filename = basename($_SERVER['REQUEST_URI']);echo ltrim(strstr($filename, '='), '=');?>">
								</div>
							</div>
							<div class="col-md-3  col-md-dy-3 no-padding-right">
							  <div class="form-group">
								<label for="DY">DY</label>
								<input type="text" class="form-control txt_date keepValue" id="DY"  placeholder="DATE" name="DY" value="<?php echo $arr1[1]; //echo date('Ymd'); ?>">
							  </div>
							</div>
							<div class="col-md-3 col-mdlan-3">
								<div class="form-group">
								  <label for="lan">LAN</label>
								  <select class="form-control txt_lan"  id="LAN" name="LAN" style="height: 30px !important;">
									<?php $sql = "SELECT id,lang, description FROM languagecode";
											$result = $conn->query($sql);
											if ($result->num_rows > 0){
												// output data of each row
												while($row = $result->fetch_assoc()) {
												  echo " <option value='".$row["lang"]."'> " . $row["lang"]. "</option>";
												   // echo " <option> " . $row["lang"]. "</option>";
											   }
											}
									?>
								  </select>
								</div>
							 </div>
							<div class="col-md-3 col-mdrec-3 no-padding-right">
							  <div class="form-group">
								<label for="rec">REC NO</label>
								<input type="text" class="form-control txt_rec" id="RECNO" name="RECNO" placeholder="REC NO">
							  </div>
							</div>
							<div class="col-md-3 no-padding-right" style="padding-top:18px;">
							<div class="form-check">
								<input type="checkbox" class="form-check-input txt_cover" name="COV-Y" value=" ">
								<label class="form-check-label txt_cover" name="COV-Y" for="cover story">Cover Story</label>
							</div>
						</div>
					</fieldset>
					<fieldset class="info_div">
					<div class="col-md-12"  style="padding-left:1px;">
						<div class="col-md-5">
						  <div class="form-group">
							<label for="ui">UI</label><?php  $uiNumber = $arr[0];  $generateNumber = str_replace('_', '', $uiNumber); ?>
							<input type="text" class="form-control txt_ui" ui_value="<?php echo $generateNumber;?>" name="UI" id="UI" placeholder="UI" >
						  </div>
						</div>
						<div class="col-md-7 no-padding-right">
						  <div class="form-group">
							<label for="doi">DOI</label>
							<input type="text" class="form-control txt_doi" moveSC="info_div"  name="DOI" id="DOI" placeholder="DOI">
						  </div>
						</div>
					</div>
						<div class="col-md-4 no-padding-right">
						  <div class="form-group">
							<label for="pge">PG</label>
							<input type="text" class="form-control txt_pg" moveSC="info_div" id="PG" name="PG" placeholder="PG">
						  </div>
						</div>
						<div class="col-md-4 no-padding-right">
							<div class="form-group">
							  <label for="spe">SPE</label>
							  <select class="form-control txt_spe" id="SPE" name="SPE" style="height: 30px !important;">
								<option></option>
								<option>preceding</option>
								<option>following</option>
								<option>Special section</option>
							  </select>
							</div>
						</div>
						<div class="col-md-4 no-padding-right">
						  <div class="form-group">
							<label for="pg">PGE</label>
							<input type="text" class="form-control txt_pge" name="PGE" id="PGE" placeholder="PGE">
						  </div>
						</div>
						<div class="col-md-4 no-padding-right">
						  <div class="form-group">
							<label for="len">LEN</label>
							<input type="text" class="form-control txt_len" name="LEN"   placeholder="LEN">
							<label id="LEN-err-dy" class="hide error-dy" for="LEN">value incorrect</label>
						  </div>
						</div>
						<div class="col-md-4 no-padding-right">
						  <div class="form-group">
							<label for="rpn">RPN</label>
							<input type="text" class="form-control txt_rpn" id="RPN" name="RPN" placeholder="RPN">
							<label id="RPN-err-dy" class="hide error-dy" for="LEN">value incorrect</label>
						  </div>
						</div>
					</fieldset>
					<fieldset class="title_div">
						<legend>Title</legend>
						<div class="col-md-9 col-mdtitle-9 no-padding-right">
						  <div class="form-group">
							<label for="TI:1">TI:1</label>
							<!--<input type="text" class="form-control txt_ti1" moveSC="title_div" id="TI1" name="TI1"  placeholder="TI:1">-->
							<textarea class="form-control txt_ti1" moveSC="title_div" id="TI1" name="TI1"  placeholder="TI:1"></textarea>
						  </div>
						</div>
						<div class="col-md-3 col-mdlan-3">
							<div class="form-group">
								<label for="TI:1:LAN">TI:1:LAN</label>
								  <select class="form-control txt_t1lan"  id="TI1LAN" name="TI1LAN" style="height: 30px !important;">
									<?php 
										$sql = "SELECT id,lang, description FROM languagecode";
											$result = $conn->query($sql);
											if ($result->num_rows > 0) {
												// output data of each row
												while($row = $result->fetch_assoc()) {
													 // echo " <option value='".$row["lang"]."'> " . $row["lang"]. "</option>";
												   echo " <option value=".$row["lang"]."> " . $row["lang"]. "</option>";
											   }
											} 
									?>
								  </select>
							</div>
						</div>
						<div class="col-md-9 col-mdtitle-9 no-padding-right">
						  <div class="form-group">
							<label for="TI:2">TI:2</label>
							<!--<input type="text" class="form-control txt_ti2"  moveSC="title_div" id="TI2" name="TI2"  placeholder="TI:2">-->
							<textarea class="form-control txt_ti2"  moveSC="title_div" id="TI2" name="TI2"  placeholder="TI:2"></textarea>
						  </div>
						</div>
						<div class="col-md-3 col-mdlan-3">
							<div class="form-group">
								<label for="TI:2:LAN">TI:2:LAN</label>
								  <select class="form-control txt_t2lan" id="TI2LAN" name="TI2LAN" style="height: 30px !important;">
									<?php $sql = "SELECT id,lang, description FROM languagecode";
											$result = $conn->query($sql);
											if ($result->num_rows > 0) {
												echo " <option></option>";
												// output data of each row
												while($row = $result->fetch_assoc()) {
												 // echo " <option value=".$row["description"]."> " . $row["description"]. "</option>"; 
												  echo " <option> " . $row["lang"]. "</option>";
											   }
											}
									?>
								  </select>
							</div>
						  
						</div>
						<div class="col-md-9 col-mdtitle-9 no-padding-right">
						  <div class="form-group">
							<label for="TI:3">TI:3</label>
							<!--<input type="text" class="form-control txt_ti3" moveSC="title_div" id="TI3" name="TI3" placeholder="TI:3">-->
							<textarea class="form-control txt_ti3" moveSC="title_div" id="TI3" name="TI3" placeholder="TI:3"></textarea>
						  </div>
						</div>
						<div class="col-md-3 col-mdlan-3">
						  <div class="form-group">
								<label for="TI:3:LAN">TI:3:LAN</label>
								  <select class="form-control txt_t3lan" id="TI3LAN" name="TI3LAN" style="height: 30px !important;">
									<?php $sql = "SELECT id,lang, description FROM languagecode";
											$result = $conn->query($sql);
											if ($result->num_rows > 0) {
												echo " <option></option>";
												// output data of each row
												while($row = $result->fetch_assoc()) {
												   echo " <option > " . $row["lang"]. "</option>";
											   }
											}
									?>
								  </select>
							</div>
						</div>
					</fieldset>
					<div style="padding-top:10px;padding-left:10px;" class="auv_div">
						<div class="col-md-12">
						  <div class="form-group">
							<label for="auv">AUV</label>
							<input type="text" class="form-control txt_auv" id="AUV" moveSC="auv_div" name="AUV" placeholder="AUV">
						  </div>
						</div>
					</div>
					<fieldset class="author_div">
						<legend>Author</legend>
						<input type="hidden" name="authorCount" id="authorCount" value="4">
							<div class="row">
								<div class="col-md-12 ">
									<fieldset class="authordiv">
										<legend>Author 1</legend>
										<div class="col-md-5 no-padding-right">
										  <div class="form-group author_fn">
											<label for="fn1">FN:1</label>
											<input type="text" class="form-control authFn txt_fn1" moveSC="author_div" id="FN1" name="FN[1]" placeholder="FN:1">
											<label id="err_txt_fn1-err-dy" class="hide error-dy">Author name can not be same</label>
										  </div>
										</div>
										<div class="col-md-5 no-padding-right">
										  <div class="form-group">
											<label for="ln1">LN:1</label>
											<input type="text" class="form-control authLn txt_ln1" moveSC="author_div" id="LN1" name="LN[1]" placeholder="LN:1">
											<label id="err_txt_ln1-err-dy" class="hide error-dy">Author name can not be same</label>
										  </div>
										</div>
										<div class="col-md-2 no-padding-right">
										  <div class="form-group">
											<label for="afi1">AFI</label>
											<input type="text" class="form-control txt_afi1 authAfi" moveSC="author_div" id="AFI1" name="AFI[1]" placeholder="AFI">
										  </div>
										  <label id="err_txt_afi1-err-dy" class="hide error-dy">Please add value</label>
										</div>
										<div class="col-md-6 no-padding-right">
										  <div class="form-group">
											<label for="aem1">AEM 1</label>
											<input type="text" class="form-control authAem txt_aem1" moveSC="author_div" id="AEM1" name="AEM[1]" placeholder="AEM">
											<label id="err_txt_aem1-err-dy" class="hide error-dy">Please select different AEM</label>
										  </div>
										</div>
										<div class="col-md-6 no-padding-right">
										  <div class="form-group">
											<label for="aem1">AEM 2</label>
											<input type="text" class="form-control txt_aemmail1" moveSC="author_div" id="AEMnew1" name="AEMnew[1]" placeholder="AEM">
											<label id="err_txt_aemmail1-err-dy" class="hide error-dy">Please select different AEM</label>
										  </div>
										</div>
									</fieldset>
									<fieldset class="authordiv">
										<legend>Author 2</legend>
										<div class="col-md-5 no-padding-right">
										  <div class="form-group author_fn">
											<label for="fn2">FN:2</label>
											<input type="text" class="form-control authFn txt_fn2" id="FN2" moveSC="author_div" name="FN[2]" placeholder="FN:2">
											<label id="err_txt_fn2-err-dy" class="hide error-dy">Author name can not be same</label>
										  </div>
										</div>
										<div class="col-md-5 no-padding-right">
										  <div class="form-group">
											<label for="ln2">LN:2</label>
											<input type="text" class="form-control authLn txt_ln2"  moveSC="author_div" id="LN2" name="LN[2]"  placeholder="LN:2">
											<label id="err_txt_ln2-err-dy" class="hide error-dy">Author name can not be same</label>
										  </div>
										</div>
										<div class="col-md-2 no-padding-right">
										  <div class="form-group">
											<label for="afi2">AFI</label>
											<input type="text" class="form-control txt_afi2 authAfi" moveSC="author_div" id="AFI2" name="AFI[2]" placeholder="AFI">
										  </div><label id="err_txt_afi2-err-dy" class="hide error-dy">Please add value</label>
										</div>
										<div class="col-md-6 no-padding-right">
										  <div class="form-group">
											<label for="aem2">AEM 1</label>
											<input type="text" class="form-control authAem txt_aem2" moveSC="author_div" id="AEM2" name="AEM[2]" placeholder="AEM">
											<label id="err_txt_aem2-err-dy" class="hide error-dy">Please select different AEM</label>
										  </div>
										</div>
										<div class="col-md-6 no-padding-right">
										  <div class="form-group">
											<label for="aem2">AEM 2</label>
											<input type="text" class="form-control txt_aemmail2" moveSC="author_div" id="AEMnew2" name="AEMnew[2]" placeholder="AEM">
											<label id="err_txt_aemmail2-err-dy" class="hide error-dy">Please select different AEM</label>
										  </div>
										</div>
									</fieldset>
									<fieldset class="authordiv">
										<legend>Author 3</legend>
										<div class="col-md-5 no-padding-right">
										  <div class="form-group author_fn">
											<label for="fn3">FN:3</label>
											<input type="text" class="form-control authFn txt_fn3" moveSC="author_div" id="FN3" name="FN[3]" placeholder="FN:3" >
											<label id="err_txt_fn3-err-dy" class="hide error-dy">Author name can not be same</label>
										  </div>
										</div>
										<div class="col-md-5 no-padding-right">
										  <div class="form-group">
											<label for="ln3">LN:3</label>
											<input type="text" class="form-control authLn txt_ln3" moveSC="author_div" id="LN3" name="LN[3]" placeholder="LN:3">
											<label id="err_txt_ln3-err-dy" class="hide error-dy">Author name can not be same</label>
										  </div>
										</div>
										<div class="col-md-2 no-padding-right">
										  <div class="form-group">
											<label for="afi3">AFI</label>
											<input type="text" class="form-control txt_afi3 authAfi" moveSC="author_div" id="AFI3" name="AFI[3]" placeholder="AFI">
										  </div>
										  <label id="err_txt_afi3-err-dy" class="hide error-dy">Please add value</label>
										</div>
										<div class="col-md-6 no-padding-right">
										  <div class="form-group">
											<label for="aem3">AEM</label>
											<input type="text" class="form-control authAem txt_aem3" moveSC="author_div" id="AEM3" name="AEM[3]"  placeholder="AEM">
											<label id="err_txt_aem3-err-dy" class="hide error-dy">Please select different AEM</label>
										  </div>
										</div>
										<div class="col-md-6 no-padding-right">
										  <div class="form-group">
											<label for="aem3">AEM</label>
											<input type="text" class="form-control txt_aemmail3" moveSC="author_div" id="AEMnew3" name="AEMnew[3]"  placeholder="AEM">
											<label id="err_txt_aemmail3-err-dy" class="hide error-dy">Please select different AEM</label>
										  </div>
										</div>
									</fieldset>
									<fieldset class="authordiv">
										<legend>Author 4</legend>
										<div class="col-md-5 no-padding-right">
										  <div class="form-group author_fn">
											<label for="fn4">FN:4</label>
											<input type="text" class="form-control authFn txt_fn4" moveSC="author_div" id="FN4" name="FN[4]" placeholder="FN:4">
											<label id="err_txt_fn4-err-dy" class="hide error-dy">Author name can not be same</label>
										  </div>
										</div>
										<div class="col-md-5 no-padding-right">
										  <div class="form-group">
											<label for="ln4">LN:4</label>
											<input type="text" class="form-control authLn txt_ln4" moveSC="author_div" id="LN4" name="LN[4]" placeholder="LN:4">
											<label id="err_txt_ln4-err-dy" class="hide error-dy">Author name can not be same</label>
										  </div>
										</div>
										<div class="col-md-2 no-padding-right">
										  <div class="form-group">
											<label for="afi4">AFI</label>
											<input type="text" class="form-control txt_afi4 authAfi" moveSC="author_div" id="AFI4" name="AFI[4]" placeholder="AFI">
										  </div>
										  <label id="err_txt_afi4-err-dy" class="hide error-dy">Please add value</label>
										</div>
										<div class="col-md-6 no-padding-right">
										  <div class="form-group">
											<label for="aem4">AEM</label>
											<input type="text" class="form-control authAem txt_aem4" moveSC="author_div" id="AEM4" name="AEM[4]" placeholder="AEM">
											<label id="err_txt_aem4-err-dy" class="hide error-dy">Please select different AEM</label>
										  </div>
										</div>
										<div class="col-md-6 no-padding-right">
										  <div class="form-group">
											<label for="aem4">AEM</label>
											<input type="text" class="form-control txt_aemmail4" moveSC="author_div" id="AEMnew4" name="AEMnew[4]" placeholder="AEM">
											<label id="err_txt_aemmail4-err-dy" class="hide error-dy">Please select different AEM</label>
										  </div>
										</div>
									</fieldset>
									<div id="add_author"></div>
									<div class="col-md-12">
										
									  <div class="form-group">
										<label class="form-check-label keywordbtn btn btn-default addAuthorBtn hide" for="key words" value="Click" onclick="add_author();">ADD Author</label>
									  </div>
									</div>
								</div>
							</div>
					</fieldset>
					<fieldset class="aff_div">
						<legend>AFF</legend>
							<div class="col-md-12">
								<div class="form-group">
									<label for="aff1">AFF:1</label>
									<!--<input type="text" class="form-control txt_aff1" moveSC="aff_div" id="AFF1" name="AFF1" placeholder="AFF:1">-->
									<textarea class="form-control txt_aff1 authAff" moveSC="aff_div" id="AFF1" name="AFF[addkey][1]" placeholder="AFF:1"></textarea>
									<label id="err_txt_aff1-err-dy" class="hide error-dy" for="LEN">Please add value</label>
								</div>
							</div>
							<div class="col-md-12">
							  <div class="form-group">
								<label for="aff2">AFF:2</label>
								<!--<input type="text" class="form-control txt_aff2" moveSC="aff_div" id="AFF2"  name="AFF2" placeholder="AFF:2">-->
								<textarea class="form-control txt_aff2 authAff" moveSC="aff_div" id="AFF2"  name="AFF[addkey][2]" placeholder="AFF:2"></textarea>
								<label id="err_txt_aff2-err-dy" class="hide error-dy" for="LEN">Please add value</label>
							  </div>
							</div>
							<div class="col-md-12">
							  <div class="form-group">
								<label for="aff3">AFF:3</label>
								<!--<input type="text" class="form-control txt_aff3" moveSC="aff_div" id="AFF3" name="AFF3" placeholder="AFF:3">-->
								<textarea class="form-control txt_aff3 authAff" moveSC="aff_div" id="AFF3" name="AFF[addkey][3]" placeholder="AFF:3"></textarea>
								<label id="err_txt_aff3-err-dy" class="hide error-dy" for="LEN">Please add value</label>
							  </div>
							</div>
							<div class="col-md-12">
							  <div class="form-group">
								<label for="aff4">AFF:4</label>
								<!--<input type="text" class="form-control txt_aff4" moveSC="aff_div" id="AFF4" name="AFF4" placeholder="AFF:4">-->
								<textarea class="form-control txt_aff4 authAff" moveSC="aff_div" id="AFF4" name="AFF[addkey][4]" placeholder="AFF:4"></textarea>
								<label id="err_txt_aff4-err-dy" class="hide error-dy" for="LEN">Please add value</label>
							  </div>
							</div>
					</fieldset>
					<fieldset>
					<div id="add_aff"></div>
						<input type="hidden" name="affCounter" id="affCounter" value="4">
						<label class="form-check-label addaffBtn btn btn-default" for="key words" value="Click" onclick="add_aff();">ADD AFF</label>
					</fieldset>
					<fieldset>
						<input type="hidden" class="txt_aso" name="ASO-Auth">
						<legend>ASA</legend>
						<div class="col-md-12">
							<div id="add_asa"></div>
							<div class="form-check">
								<label class="form-check-label keywordbtn btn btn-default" for="key words" value="Click" onclick="add_fields();">									ADD ASA</label>
							</div>
						</div>
					</fieldset>
					<div class="col-md-12">
						<div class="col-md-6">
						  <div class="form-group">
							<label for="caption">KW Caption</label>
							<input type="text" class="form-control txt_kwt" id="KWT" moveSC="pictorial_div" name="KWT" placeholder="KW Caption">
						  </div>
						</div>
						<div class="col-md-6">
							<div class="form-group">
								  <label for="lan">LAN</label>
								  <select class="form-control txt_lankwd" id="fs_keywprd1" name="LANkwd" style="height: 30px !important;">
									<?php $sql = "SELECT id,lang, description FROM languagecode";
											$result = $conn->query($sql);
											if ($result->num_rows > 0) {
												// echo " <option></option>";
												// output data of each row
												while($row = $result->fetch_assoc()) {
												   echo " <option> " . $row["lang"]. "</option>";
											   }
											}
									?>
								  </select>
							</div>
						</div>
					</div>
					<div class="keyword_div">
					<fieldset class="keyword_fs">
						<legend>KeyWords</legend>
						<div class="col-md-6">
						  <div class="form-group">
							<label for="keywords">KeyWords:01</label>
							<input type="text" class="form-control txt_keyword1 keywrd" moveSC="kwd_div" id="KWD1" name="KWD1" placeholder="KeyWords:01">
							<label id="keyword1-err-dy" class="hide error-dy" for="LEN">Please add different keyword</label>
						  </div>
						</div>
						<div class="col-md-6">
						  <div class="form-group">
							<label for="KeyWords2">KeyWords:02</label>
							<input type="text" class="form-control txt_keyword2 keywrd" moveSC="kwd_div" id="KWD2" name="KWD2"  placeholder="KeyWords:02">
							<label id="keyword2-err-dy" class="hide error-dy" for="LEN">Please add different keyword</label>
						  </div>
						</div>
						<div class="col-md-6">
						  <div class="form-group">
							<label for="KeyWords3">KeyWords:03</label>
							<input type="text" class="form-control txt_keyword3 keywrd" moveSC="kwd_div" name="KWD3" name="KWD3"  placeholder="KeyWords:03">
							<label id="keyword3-err-dy" class="hide error-dy" for="LEN">Please add different keyword</label>
						  </div>
						</div>
						<div class="col-md-6">
						  <div class="form-group">
							<label for="KeyWords4">KeyWords:04</label>
							<input type="text" class="form-control txt_keyword4 keywrd" moveSC="kwd_div" id="KWD4" name="KWD4" placeholder="KeyWords:04">
							<label id="keyword4-err-dy" class="hide error-dy" for="LEN">Please add different keyword</label>
						  </div>
						</div>
						<div class="col-md-6">
						  <div class="form-group">
							<label for="KeyWords5">KeyWords:05</label>
							<input type="text" class="form-control txt_keyword5 keywrd" moveSC="kwd_div" id="KWD5" name="KWD5" placeholder="KeyWords:05">
							<label id="keyword5-err-dy" class="hide error-dy" for="LEN">Please add different keyword</label>
						  </div>
						</div>
						<div class="col-md-6">
						  <div class="form-group">
							<label for="KeyWords6">KeyWords:06</label>
							<input type="text" class="form-control txt_keyword6 keywrd" moveSC="kwd_div" id="KWD6" name="KWD6" placeholder="KeyWords:06">
							<label id="keyword6-err-dy" class="hide error-dy" for="LEN">Please add different keyword</label>
						  </div>
						</div>
						<div class="col-md-6">
						  <div class="form-group">
							<label for="KeyWords7">KeyWords:07</label>
							<input type="text" class="form-control txt_keyword7 keywrd" moveSC="kwd_div" id="KWD7"name="KWD7" placeholder="KeyWords:07">
							<label id="keyword7-err-dy" class="hide error-dy" for="LEN">Please add different keyword</label>
						  </div>
						</div>
						<div class="col-md-6">
						  <div class="form-group">
							<label for="KeyWords8">KeyWords:08</label>
							<input type="text" class="form-control txt_keyword8 keywrd" moveSC="kwd_div" id="KWD8"  name="KWD8" placeholder="KeyWords:08">
							<label id="keyword8-err-dy" class="hide error-dy" for="LEN">Please add different keyword</label>
						  </div>
						</div>
						<div class="col-md-6">
						  <div class="form-group">
							<label for="KeyWords9">KeyWords:09</label>
							<input type="text" class="form-control txt_keyword9 keywrd" moveSC="kwd_div" id="KWD9" name="KWD9"  placeholder="KeyWords:09">
						  </div>
						</div>
						<div class="col-md-6">
						  <div class="form-group">
							<label for="KeyWords10">KeyWords:10</label>
							<input type="text" class="form-control txt_keyword10 keywrd" moveSC="kwd_div" id="KWD10" name="KWD10" placeholder="KeyWords:10">
							<label id="keyword9-err-dy" class="hide error-dy" for="LEN">Please add different keyword</label>
						  </div>
						</div>
					</fieldset>
					<fieldset>
					<div id="add_keyword"></div>
						<input type="hidden" name="keywordCounter" id="keywordCounter" value="10">
						<label class="form-check-label addKeywordBtn btn btn-default" for="key words" value="Click" onclick="add_keyword();">	ADD KEYWORDS</label>
					</fieldset>
					</div>
					<fieldset style="padding-top:10px; padding-left:10px;" class="pictorial_div">
						<div class="col-md-2 col-mdpic-2 no-padding-right">
						  <div class="form-group">
							<label for="photo">BW</label>
							<input type="text" class="form-control " id="photo" moveSC="pictorial_div" name="photo" placeholder="BW">
						  </div>
						</div>
						<div class="col-md-2 col-mdpic-2 no-padding-right">
						  <div class="form-group">
							<label for="colorphoto">CO</label>
							<input type="text" class="form-control " id="colorphoto"  moveSC="pictorial_div" name="colorphoto" placeholder="CO">
						  </div>
						</div>
						<div class="col-md-2 col-mdpic-2 no-padding-right">
						  <div class="form-group">
							<label for="charts">CHT</label>
							<input type="text" class="form-control " id="charts" moveSC="pictorial_div" name="charts" placeholder="CHT">
						  </div>
						</div>
						<div class="col-md-2 col-mdpic-2 no-padding-right">
						  <div class="form-group">
							<label for="cartoons">CRT</label>
							<input type="text" class="form-control " id="cartoons" moveSC="pictorial_div" name="cartoons" placeholder="CRT">
						  </div>
						</div>
						<div class="col-md-2 col-mdpic-2 no-padding-right">
						  <div class="form-group">
							<label for="diagrams">DIA</label>
							<input type="text" class="form-control " id="diagrams" moveSC="pictorial_div" name="diagrams" placeholder="DIA">
						  </div>
						</div>
						<div class="col-md-2 col-mdpic-2 no-padding-right">
						  <div class="form-group">
							<label for="graphs">GR</label>
							<input type="text" class="form-control " id="graphs" moveSC="pictorial_div" name="graphs" placeholder="GR">
						  </div>
						</div>
						<div class="col-md-2 col-mdpic-2 no-padding-right">
						  <div class="form-group">
							<label for="maps">MAP</label>
							<input type="text" class="form-control " id="maps" moveSC="pictorial_div" name="maps" placeholder="MAP">
						  </div>
						</div>
					</fieldset>
					<fieldset class="inset_div">
						<legend>INSET</legend>
							<div class="col-md-6">
								<div class="form-group">
									<label for="inset1">INSET:1</label>
									<input type="text" class="form-control txt_inset1" moveSC="inset_div" id="inset1" name="INSET:1" placeholder="INSET:1">
									<label id="inset_div-err-dy" class="hide error-dy" for="UI">Pldfdfrs.</label>
								</div>
							</div>
							<div class="col-md-6">
							  <div class="form-group">
								<label for="inset2">INSET:2</label>
								<input type="text" class="form-control txt_inset2" moveSC="inset_div" id="inset2" name="INSET:2" placeholder="INSET:2">
							  </div>
							</div>
							<div class="col-md-6">
							  <div class="form-group">
								<label for="inset3">INSET:3</label>
								<input type="text" class="form-control txt_inset3" moveSC="inset_div" id="inset3" name="INSET:3" placeholder="INSET:3">
							  </div>
							</div>
							<div class="col-md-6">
							  <div class="form-group">
								<label for="inset4">INSET:4</label>
								<input type="text" class="form-control txt_inset4" moveSC="inset_div" id="inset4" name="INSET:4" placeholder="INSET:4">
							  </div>
							</div>
					</fieldset>
					<input class="submit btn btn-primary keepValue" id="submitbtn" type="submit"  value="Submit" style="padding-left: 10px;padding-right: 10px;padding-top: 3px;padding-bottom: 3px; margin-left: 20px;">
				</form>
			</div>
		</div><!--UserForm-->
			<?php 
				//echo '</div>';
				}
				else{
					echo '<div id="userForm" style="max-width: 550px;height:auto; position: fixed;top:-5px;padding-top: 46px;display:none;"></div>';
				}
			?>
			
			
			
          <div id="viewer" class="pdfViewer"></div>
        </div>

        <div id="errorWrapper" hidden='true'>
          <div id="errorMessageLeft">
            <span id="errorMessage"></span>
            <button id="errorShowMore" data-l10n-id="error_more_info">
              More Information
            </button>
            <button id="errorShowLess" data-l10n-id="error_less_info" hidden='true'>
              Less Information
            </button>
          </div>
          <div id="errorMessageRight">
            <button id="errorClose" data-l10n-id="error_close">
              Close
            </button>
          </div>
          <div class="clearBoth"></div>
          <textarea id="errorMoreInfo" hidden='true' readonly="readonly"></textarea>
        </div>
		
      </div> <!-- mainContainer -->

      <div id="overlayContainer" class="hidden">
        <div id="passwordOverlay" class="container hidden">
          <div class="dialog">
            <div class="row">
              <p id="passwordText" data-l10n-id="password_label">Enter the password to open this PDF file:</p>
            </div>
            <div class="row">
              <input type="password" id="password" class="toolbarField">
            </div>
            <div class="buttonRow">
              <button id="passwordCancel" class="overlayButton"><span data-l10n-id="password_cancel">Cancel</span></button>
              <button id="passwordSubmit" class="overlayButton"><span data-l10n-id="password_ok">OK</span></button>
            </div>
          </div>
        </div>
        <div id="documentPropertiesOverlay" class="container hidden">
          <div class="dialog">
            <div class="row">
              <span data-l10n-id="document_properties_file_name">File name:</span> <p id="fileNameField">-</p>
            </div>
            <div class="row">
              <span data-l10n-id="document_properties_file_size">File size:</span> <p id="fileSizeField">-</p>
            </div>
            <div class="separator"></div>
            <div class="row">
              <span data-l10n-id="document_properties_title">Title:</span> <p id="titleField">-</p>
            </div>
            <div class="row">
              <span data-l10n-id="document_properties_author">Author:</span> <p id="authorField">-</p>
            </div>
            <div class="row">
              <span data-l10n-id="document_properties_subject">Subject:</span> <p id="subjectField">-</p>
            </div>
            <div class="row">
              <span data-l10n-id="document_properties_keywords">Keywords:</span> <p id="keywordsField">-</p>
            </div>
            <div class="row">
              <span data-l10n-id="document_properties_creation_date">Creation Date:</span> <p id="creationDateField">-</p>
            </div>
            <div class="row">
              <span data-l10n-id="document_properties_modification_date">Modification Date:</span> <p id="modificationDateField">-</p>
            </div>
            <div class="row">
              <span data-l10n-id="document_properties_creator">Creator:</span> <p id="creatorField">-</p>
            </div>
            <div class="separator"></div>
            <div class="row">
              <span data-l10n-id="document_properties_producer">PDF Producer:</span> <p id="producerField">-</p>
            </div>
            <div class="row">
              <span data-l10n-id="document_properties_version">PDF Version:</span> <p id="versionField">-</p>
            </div>
            <div class="row">
              <span data-l10n-id="document_properties_page_count">Page Count:</span> <p id="pageCountField">-</p>
            </div>
            <div class="row">
              <span data-l10n-id="document_properties_page_size">Page Size:</span> <p id="pageSizeField">-</p>
            </div>
            <div class="separator"></div>
            <div class="row">
              <span data-l10n-id="document_properties_linearized">Fast Web View:</span> <p id="linearizedField">-</p>
            </div>
            <div class="buttonRow">
              <button id="documentPropertiesClose" class="overlayButton"><span data-l10n-id="document_properties_close">Close</span></button>
            </div>
          </div>
        </div>
        <div id="printServiceOverlay" class="container hidden">
          <div class="dialog">
            <div class="row">
              <span data-l10n-id="print_progress_message">Preparing document for printing…</span>
            </div>
            <div class="row">
              <progress value="0" max="100"></progress>
              <span data-l10n-id="print_progress_percent" data-l10n-args='{ "progress": 0 }' class="relative-progress">0%</span>
            </div>
            <div class="buttonRow">
              <button id="printCancel" class="overlayButton"><span data-l10n-id="print_progress_close">Cancel</span></button>
            </div>
          </div>
        </div>
      </div>  <!-- overlayContainer -->
	  <div id="selectedContentContainer" style="display: none;"></div>
    <!--</div>  outerContainer -->
    <div id="printContainer"></div>


<menu class="menu">
	 <li class="menu-item doi" id="doi"  onclick="copyConent('doi')">
		<button type="button" class="menu-btn doi"><span class="menu-text">DOI</span> </button>
	  </li>
  <li class="menu-item submenu">
    <button type="button" class="menu-btn"><span class="menu-text">TI</span> </button>
    <menu class="menu">
      <li class="menu-item ti1"  onclick="copyConent('ti1')">
        <button type="button" class="menu-btn ti1"><span class="menu-text">TI:1</span> </button>
      </li>
      <li class="menu-item ti2"  onclick="copyConent('ti2')">
        <button type="button" class="menu-btn ti2"><span class="menu-text">TI:2</span> </button>
      </li>
	   <li class="menu-item ti3" onclick="copyConent('ti3')">
        <button type="button" class="menu-btn ti3"><span class="menu-text">TI:3</span> </button>
      </li>
    </menu>
  </li>
   <li class="menu-item submenu">
    <button type="button" class="menu-btn"><span class="menu-text">INSET</span> </button>
    <menu class="menu">
      <li class="menu-item inset1" onclick="copyConent('inset1')">
        <button type="button" class="menu-btn inset1"><span class="menu-text">INSET:1</span> </button>
      </li>
      <li class="menu-item inset2"  onclick="copyConent('inset2')">
        <button type="button" class="menu-btn inset2"><span class="menu-text">INSET:2</span> </button>
      </li>
	   <li class="menu-item inset3" onclick="copyConent('inset3')">
        <button type="button" class="menu-btn inset3"><span class="menu-text">INSET:3</span> </button>
      </li>
	  <li class="menu-item inset4" onclick="copyConent('inset4')">
        <button type="button" class="menu-btn inset4"><span class="menu-text">INSET:4</span> </button>
      </li>
    </menu>
  </li>

	  <li class="menu-item auv auvLI" onclick="copyConent('auv')">
		<button type="button" class="menu-btn auv"><span class="menu-text">AUV</span> </button>
	  </li>
		  
  <li class="menu-item submenu authorSubLI">
    <button type="button" class="menu-btn"><span class="menu-text" id="authorMenu1">AUTHOR1</span> </button>
    <menu class="menu">
      <li class="menu-item fn1 authorLI" id="contextmenu_fn1" onclick="copyConent('fn1', 'author')">
		<button type="button" class="menu-btn fn1 authorLI"><span class="menu-text">FN1</span> </button>
		</li>
	  <li class="menu-item ln1 authorLI" onclick="copyConent('ln1', 'author')">
		<button type="button" class="menu-btn ln1 authorLI"><span class="menu-text">LN1</span> </button>
	  </li>
	  <!-- <li class="menu-item afi1 authorLI" onclick="copyConent('afi1', 'author')">
		<button type="button" class="menu-btn afi1 authorLI"><span class="menu-text">AFI1</span> </button>
	  </li> -->
	  <li class="menu-item aem1 authorLI" onclick="copyConent('aem1', 'author')">
		<button type="button" class="menu-btn aem1 authorLI"><span class="menu-text">AEM1</span> </button>
	  </li>
	  <li class="menu-item aemmail1 authorLI" onclick="copyConent('aemmail1', 'author')">
		<button type="button" class="menu-btn aemmail1 authorLI"><span class="menu-text">AEM2</span> </button>
	  </li>
    </menu>
  </li>
  <li class="menu-item submenu authorSubLI">
    <button type="button" class="menu-btn"><span class="menu-text" id="authorMenu2">AUTHOR2</span> </button>
    <menu class="menu">
      <li class="menu-item fn2"  onclick="copyConent('fn2', 'author')">
		<button type="button" class="menu-btn fn2"><span class="menu-text">FN2</span> </button>
		</li>
	  <li class="menu-item ln2" onclick="copyConent('ln2', 'author')">
		<button type="button" class="menu-btn ln2"><span class="menu-text">LN2</span> </button>
	  </li>
	  <li class="menu-item aem2" onclick="copyConent('aem2', 'author')">
		<button type="button" class="menu-btn aem2"><span class="menu-text">AEM1</span> </button>
	  </li>
	  <li class="menu-item aemmail2" onclick="copyConent('aemmail2', 'author')">
		<button type="button" class="menu-btn aemmail2"><span class="menu-text">AEM2</span> </button>
	  </li>
    </menu>
  </li>
<li class="menu-item submenu authorSubLI">
    <button type="button" class="menu-btn"><span class="menu-text"  id="authorMenu3">AUTHOR3</span> </button>
    <menu class="menu">
      <li class="menu-item fn3"  onclick="copyConent('fn3', 'author')">
		<button type="button" class="menu-btn fn3"><span class="menu-text">FN3</span> </button>
		</li>
	  <li class="menu-item ln3" onclick="copyConent('ln3', 'author')">
		<button type="button" class="menu-btn ln3"><span class="menu-text">LN3</span> </button>
	  </li>
	  <li class="menu-item aem3" onclick="copyConent('aem3', 'author')">
		<button type="button" class="menu-btn aem3"><span class="menu-text">AEM1</span> </button>
	  </li>
	  <li class="menu-item aemmail3" onclick="copyConent('aemmail3', 'author')">
		<button type="button" class="menu-btn aemmail3"><span class="menu-text">AEM2</span> </button>
	  </li>
    </menu>
  </li>
  <li class="menu-item submenu authorSubLI">
    <button type="button" class="menu-btn"><span class="menu-text" id="authorMenuNext">AUTHOR4</span> </button>
    <menu class="menu">
      <li class="menu-item fn4"  onclick="copyConent('fn4', 'nextAuthor')">
		<button type="button" class="menu-btn fn4"><span class="menu-text">FN4</span> </button>
		</li>
	  <li class="menu-item ln4" onclick="copyConent('ln4', 'nextAuthor')">
		<button type="button" class="menu-btn ln4"><span class="menu-text">LN4</span> </button>
	  </li>
	  <li class="menu-item aem4" onclick="copyConent('aem4', 'nextAuthor')">
		<button type="button" class="menu-btn aem4"><span class="menu-text">AEM1</span> </button>
	  </li>
	  <li class="menu-item aemmail4" onclick="copyConent('aemmail4', 'nextAuthor')">
		<button type="button" class="menu-btn aemmail4"><span class="menu-text">AEM2</span> </button>
	  </li>
    </menu>
  </li>
  <li class="menu-item submenu hideauthor4 hide">
    <button type="button" class="menu-btn"><span class="menu-text" id="authorMenuNext">AUTHOR4</span> </button>
    <menu class="menu">
      <li class="menu-item fn4"  onclick="copyConent('fn4', 'nextAuthor')">
		<button type="button" class="menu-btn fn4"><span class="menu-text">FN4</span> </button>
		</li>
	  <li class="menu-item ln4" onclick="copyConent('ln4', 'nextAuthor')">
		<button type="button" class="menu-btn ln4"><span class="menu-text">LN4</span> </button>
	  </li>
	  <li class="menu-item aem4" onclick="copyConent('aem4', 'nextAuthor')">
		<button type="button" class="menu-btn aem4"><span class="menu-text">AEM1</span> </button>
	  </li>
	  <li class="menu-item aemmail4" onclick="copyConent('aemmail4', 'nextAuthor')">
		<button type="button" class="menu-btn aemmail4"><span class="menu-text">AEM2</span> </button>
	  </li>
    </menu>
  </li>
   <li class="menu-item submenu">
    <button type="button" class="menu-btn"><span class="menu-text">AFF</span> </button>
    <menu class="menu affmenu" id="test">
      <li class="menu-item aff1"  onclick="copyConent('aff1')">
		<button type="button" class="menu-btn aff1"><span class="menu-text">AFF:1</span> </button>
		</li>
	  <li class="menu-item aff2" onclick="copyConent('aff2')">
		<button type="button" class="menu-btn aff2"><span class="menu-text">AFF:2</span> </button>
	  </li>
	  <li class="menu-item aff3" onclick="copyConent('aff3')">
		<button type="button" class="menu-btn aff3"><span class="menu-text">AFF:3</span> </button>
	  </li>
	  <li class="menu-item aff4" onclick="copyConent('aff4' , 'lastaff')">
		<button type="button" class="menu-btn aff4"><span class="menu-text">AFF:4</span> </button>
	  </li>
    </menu>
  </li>
  <li class="menu-item kwt"  onclick="copyConent('kwt')">
    <button type="button" class="menu-btn kwt"><span class="menu-text kwt">KW Caption</span> </button>
  </li>
  <li class="menu-item submenu">
    <button type="button" class="menu-btn"><span class="menu-text">KEYWORDS</span> </button>
    <menu class="menu keywordMenu">
      <li class="menu-item keyword1"  onclick="copyConent('keyword1')">
		<button type="button" class="menu-btn keyword1"><span class="menu-text">KeyWords:1</span> </button>
		</li>
	  <li class="menu-item keyword2" onclick="copyConent('keyword2')">
		<button type="button" class="menu-btn keyword2"><span class="menu-text">KeyWords:2</span> </button>
	  </li>
	  <li class="menu-item keyword3" onclick="copyConent('keyword3')">
		<button type="button" class="menu-btn KeyWords3"><span class="menu-text">KeyWords:3</span> </button>
	  </li>
	  <li class="menu-item keyword4" onclick="copyConent('keyword4')">
		<button type="button" class="menu-btn keyword4"><span class="menu-text">KeyWords:4</span> </button>
	  </li>
	  <li class="menu-item keyword5" onclick="copyConent('keyword5')">
		<button type="button" class="menu-btn keyword5"><span class="menu-text">KeyWords:5</span> </button>
	  </li>
	  <li class="menu-item keyword6" onclick="copyConent('keyword6')">
		<button type="button" class="menu-btn keyword6"><span class="menu-text">KeyWords:6</span> </button>
	  </li>
	  <li class="menu-item keyword7" onclick="copyConent('keyword7')">
		<button type="button" class="menu-btn keyword7"><span class="menu-text">KeyWords:7</span> </button>
	  </li>
	  <li class="menu-item keyword8" onclick="copyConent('keyword8')">
		<button type="button" class="menu-btn keyword8"><span class="menu-text">KeyWords:8</span> </button>
	  </li>
	  <li class="menu-item keyword6" onclick="copyConent('keyword9')">
		<button type="button" class="menu-btn keyword9"><span class="menu-text">KeyWords:9</span> </button>
	  </li>
	  <li class="menu-item keyword6" onclick="copyConent('keyword10', 'lastKeyword')">
		<button type="button" class="menu-btn keyword10"><span class="menu-text">KeyWords:10</span> </button>
	  </li>
    </menu>
  </li>
  
  <li class="menu-item submenu">
    <button type="button" class="menu-btn"><span class="menu-text">IMAGE</span> </button>
    <menu class="menu">
      <li class="menu-item"  id="AddButton">
			<button type="button" id="AddButton" class="menu-btn"><span class="menu-text">BW</span></button>
		  </li>
		  <li class="menu-item"  id="addcolorphoto">
			<button type="button" id="addcolorphoto" class="menu-btn"><span class="menu-text">CO</span></button>
		  </li>
		  <li class="menu-item"  id="addcharts">
			<button type="button" id="addcharts" class="menu-btn"><span class="menu-text">CHT</span></button>
		  </li>
		  <li class="menu-item"  id="addacartoons">
			<button type="button" id="addacartoons" class="menu-btn"><span class="menu-text">CRT</span></button>
		  </li>
		  <li class="menu-item"  id="adddiagrams">
			<button type="button" id="adddiagrams" class="menu-btn"><span class="menu-text">DIA</span></button>
		  </li>
		  <li class="menu-item"  id="addgraphs">
			<button type="button" id="addgraphs" class="menu-btn"><span class="menu-text">GR</span></button>
		  </li>
		  <li class="menu-item"  id="addmaps">
			<button type="button" id="addmaps" class="menu-btn"><span class="menu-text">MAP</span></button>
		  </li>
    </menu>
  </li>
  <!--<li class="menu-item"  id="AddButton">
    <button type="button" id="AddButton" class="menu-btn"><span class="menu-text">IMAGE</span></button>
  </li>
  <li class="menu-item"  id="addcolorphoto">
    <button type="button" id="addcolorphoto" class="menu-btn"><span class="menu-text">ColorPhoto</span></button>
  </li>
  <li class="menu-item"  id="addcharts">
    <button type="button" id="addcharts" class="menu-btn"><span class="menu-text">Charts</span></button>
  </li>
  <li class="menu-item"  id="addacartoons">
    <button type="button" id="addacartoons" class="menu-btn"><span class="menu-text">Cartoons</span></button>
  </li>
  <li class="menu-item"  id="adddiagrams">
    <button type="button" id="adddiagrams" class="menu-btn"><span class="menu-text">Diagrams</span></button>
  </li>
  <li class="menu-item"  id="addgraphs">
    <button type="button" id="addgraphs" class="menu-btn"><span class="menu-text">Graphs</span></button>
  </li>
  <li class="menu-item"  id="addmaps">
    <button type="button" id="addmaps" class="menu-btn"><span class="menu-text">Maps</span></button>
  </li>
    <li class="menu-item " onclick="myFunction()">
		<button type="button" class="menu-btn "><span class="menu-text auv">COPY</span> </button>
	  </li>-->
	  <!--<li class="menu-item " onclick="myFunction()">
		<button type="button" class="menu-btn "><span class="menu-text auv">PASTE</span> </button>
	  </li>-->
	
</menu>
<script>
function openfilePdf(filename){
	//alert('test');
	window.localStorage.setItem('ett_val', 1);
	<?php $_SESSION['ett_count'] = 1;?>
	window.location.href='?file='+filename;
	
} 
nextAsa = 1;
function add_fields() {
	 var formvalue = [];
		$.ajax({
			url: "lanselectbox.php",
			type:"POST",
			data:formvalue,
			success: function(result){
				var addto = "#add_asa" + nextAsa;
				var objTo = document.getElementById('add_asa')
				var divAdd = document.createElement("div");
				if (nextAsa == 1 ){
					divAdd.innerHTML = '<fieldset><div class="col-md-4" style="padding-left: 0px !important;"><div class="form-group"><label class="col-md-12" for="asa:1:LAN">ASA:'+ nextAsa +':LAN</label><select id="asa_lan'+nextAsa+'" class="asaLanSelect form-control seletcLAN'+nextAsa+' txt_'+ nextAsa + '" name="ASALAN['+ nextAsa +']" style="height: 30px !important;">'+result+'</select><label id="asa_lan'+ nextAsa +'-err-dy" class="hide error-dy">Please select different Lang</label></div></div><div class="col-md-12" style="padding-left: 0px;"><div class="form-group"><label for="asa:1">ASA:' + nextAsa + '</label><textarea rows="20" class="form-control asaInput asa_txt_'+ nextAsa + '" name="ASA[' + nextAsa + ']"></textarea><label id="err_asa_txt_'+ nextAsa +'-err-dy" class="hide error-dy col-md-12">Asa must end wih a fullstop.</label></div></div></fieldset>';
					
				}else{
					 divAdd.innerHTML = '<fieldset><div class="col-md-4" style="padding-left: 0px !important;"><div class="form-group"><label for="asa:1:LAN" class="col-md-12">ASA:'+ nextAsa +':LAN</label><select id="asa_lan'+nextAsa+'" class="asaLanSelect form-control txt_'+ nextAsa + '" name="ASALAN['+ nextAsa +']" style="height: 30px !important;"><option></option>'+result+'</select><label id="asa_lan'+ nextAsa +'-err-dy" class="hide error-dy">Please select different Lang</label></div></div><div class="col-md-12" style="padding-left: 0px;"><div class="form-group"><label for="asa:1">ASA:' + nextAsa + '</label><textarea rows="20" class="form-control asaInput asa_txt_'+ nextAsa + '" name="ASA[' + nextAsa + ']"></textarea><label id="err_asa_txt_'+ nextAsa +'-err-dy" class="hide error-dy col-md-12">Asa must end wih a fullstop.</label></div></div></fieldset>';
				}
				objTo.appendChild(divAdd);$('.seletcLAN1').val('EN'); 
				nextAsa = nextAsa + 1;
						},
			
	});
	return false;
	
	
}

/*ADD AFF */
function add_aff() {
	var affHtml = '';
	var affCounter1 = parseInt($('#affCounter').val())+1;
	var affCounter4 = parseInt($('#affCounter').val())+4;
	for(k = affCounter1; k<=affCounter4;k++){
		var copyFn = "copyConent('aff"+k+"')";
		if(k == affCounter4)
			var copyFn = "copyConent('aff"+k+"', 'lastaff')";
		affHtml = affHtml+'<li class="menu-item aff'+k+'"  onclick="'+copyFn+'"><button type="button" class="menu-btn aff1"><span class="menu-text">AFF:'+k+'</span> </button></li>';
	}
	$('.affmenu').html(affHtml);
	var affCounter = parseInt($('#affCounter').val())+1;
	var affclass = parseInt($('.aff_div').val())+1;
	var affDivHtml = '<fieldset class="aff_div"><legend>AFF</legend>';
	var affHtml = '';
	var countAdd4 = parseInt($('#affCounter').val())+4;
	for(i = affCounter; i<=countAdd4;i++){
		affHtml = affHtml+ '<div class="col-md-12"><div class="form-group"><label for="aff">AFF:'+i+'</label><textarea class="form-control authAff txt_aff'+i+' id="AFF" name="AFF[addkey]['+i+']" placeholder="AFF:'+i+'"></textarea><label id="err_txt_aff'+i+'-err-dy" class="hide error-dy" for="LEN">Please add value</label> </div></div>';
	}
	affHtml = affDivHtml+affHtml+'</fieldset>';
	//affHtml = affHtml;
	$('#add_aff').append(affHtml);
	$('#affCounter').val(countAdd4);
}


var author = 4;
function add_author() {
	var authorCount = $('#authorCount').val();
    
	var author1 = parseInt(authorCount)+1;
	var author2 = parseInt(authorCount)+2;
	var author3 = parseInt(authorCount)+3;
	var author4 = parseInt(authorCount)+4;
									
	var authHtml = '<fieldset class="authordiv"><legend>Author '+author1+'</legend><div class="col-md-5 no-padding-right"><div class="form-group author_fn"><label for="fn'+author1+'">FN:'+author1+'</label><input type="text" class="form-control authFn txt_fn'+author1+'" moveSC="author_div" id="FN'+author1+'" name="FN['+author1+']" placeholder="FN:'+author1+'"><label id="err_txt_fn'+author1+'-err-dy" class="hide error-dy">Author name can not be same</label></div></div><div class="col-md-5 no-padding-right"><div class="form-group"><label for="ln'+author1+'">LN:'+author1+'</label><input type="text" class="form-control authLn txt_ln'+author1+'" moveSC="author_div" id="LN'+author1+'" name="LN['+author1+']" placeholder="LN:'+author1+'"><label id="err_txt_ln'+author1+'-err-dy" class="hide error-dy">Author name can not be same</label></div></div><div class="col-md-2 no-padding-right"><div class="form-group"><label for="afi'+author1+'">AFI</label><input type="text" class="form-control txt_afi'+author1+' authAfi" moveSC="author_div" id="AFI'+author1+'" name="AFI['+author1+']" placeholder="AF'+author1+'"><label id="err_txt_afi'+author1+'-err-dy" class="hide error-dy">Please add value</label></div></div><div class="col-md-6 no-padding-right"><div class="form-group"><label for="aem'+author1+'">AEM</label><input type="text" class="form-control authAem txt_aem'+author1+'" moveSC="author_div" id="AEM'+author1+'" name="AEM['+author1+']" placeholder="AEM"><label id="err_txt_aem'+author1+'-err-dy" class="hide error-dy">Please select different AEM</label></div></div><div class="col-md-6 no-padding-right"><div class="form-group"><label for="aem'+author1+'">AEM</label><input type="text" class="form-control txt_aemmail'+author1+'" moveSC="author_div" id="AEMnew'+author1+'" name="AEMnew['+author1+']" placeholder="AEM"><label id="err_txt_aemmail'+author1+'-err-dy" class="hide error-dy">Please select different AEM</label></div></div></fieldset><fieldset class="authordiv"><legend>Author '+author2+'</legend><div class="col-md-5 no-padding-right"><div class="form-group author_fn"><label for="fn'+author2+'">FN:'+author2+'</label><input type="text" class="form-control authFn txt_fn'+author2+'" id="FN'+author2+'" moveSC="author_div" name="FN['+author2+']" placeholder="FN:'+author2+'"><label id="err_txt_fn'+author2+'-err-dy" class="hide error-dy">Author name can not be same</label></div></div><div class="col-md-5 no-padding-right"><div class="form-group"><label for="ln'+author2+'">LN:'+author2+'</label><input type="text" class="form-control authLn txt_ln'+author2+'"  moveSC="author_div" id="LN'+author2+'" name="LN['+author2+']"  placeholder="LN:'+author2+'"><label id="err_txt_ln'+author2+'-err-dy" class="hide error-dy">Author name can not be same</label></div></div><div class="col-md-2 no-padding-right"><div class="form-group"><label for="afi'+author2+'">AFI</label><input type="text" class="form-control txt_afi'+author2+' authAfi" moveSC="author_div" id="AFI'+author2+'" name="AFI['+author2+']" placeholder="AFI"><label id="err_txt_afi'+author2+'-err-dy" class="hide error-dy">Please add value</label></div></div><div class="col-md-6 no-padding-right"><div class="form-group"><label for="aem'+author2+'">AEM</label><input type="text" class="form-control authAem txt_aem'+author2+'" moveSC="author_div" id="AEM'+author2+'" name="AEM['+author2+']" placeholder="AEM"><label id="err_txt_aem'+author2+'-err-dy" class="hide error-dy">Please select different AEM</label> </div></div><div class="col-md-6 no-padding-right"><div class="form-group"><label for="aem'+author2+'">AEM</label><input type="text" class="form-control txt_aemmail'+author2+'" moveSC="author_div" id="AEMnew'+author2+'" name="AEMnew['+author2+']"placeholder="AEM"><label id="err_txt_aemmail'+author2+'-err-dy" class="hide error-dy">Please select different AEM</label></div></div></fieldset><fieldset class="authordiv"><legend>Author '+author3+'</legend><div class="col-md-5 no-padding-right"><div class="form-group author_fn"><label for="fn'+author3+'">FN:'+author3+'</label><input type="text" class="form-control authFn txt_fn'+author3+'" moveSC="author_div" id="FN'+author3+'" name="FN['+author3+']" placeholder="FN:'+author3+'" ><label id="err_txt_fn'+author3+'-err-dy" class="hide error-dy">Author name can not be same</label></div></div><div class="col-md-5 no-padding-right"><div class="form-group"><label for="ln'+author3+'">LN:'+author3+'</label><input type="text" class="form-control authLn txt_ln'+author3+'" moveSC="author_div" id="LN'+author3+'" name="LN['+author3+']" placeholder="LN:'+author3+'"><label id="err_txt_ln'+author3+'-err-dy" class="hide error-dy">Author name can not be same</label></div></div><div class="col-md-2 no-padding-right"><div class="form-group"><label for="afi'+author3+'">AFI</label><input type="text" class="form-control txt_afi'+author3+' authAfi" moveSC="author_div" id="AFI'+author3+'" name="AFI['+author3+']" placeholder="AFI"><label id="err_txt_afi'+author3+'-err-dy" class="hide error-dy">Please add value</label> </div></div><div class="col-md-6 no-padding-right"><div class="form-group"><label for="aem'+author3+'">AEM</label><input type="text" class="form-control authAem txt_aem'+author3+'" moveSC="author_div" id="AEM'+author3+'" name="AEM['+author3+']"  placeholder="AEM"><label id="err_txt_aem'+author3+'-err-dy" class="hide error-dy">Please select different AEM</label></div></div><div class="col-md-6 no-padding-right"><div class="form-group"><label for="aem'+author3+'">AEM</label><input type="text" class="form-control txt_aemmail'+author3+'" moveSC="author_div" id="AEMnew'+author3+'" name="AEMnew['+author3+']"  placeholder="AEM"><label id="err_txt_aemmail'+author3+'-err-dy" class="hide error-dy">Please select different AEM</label></div></div></fieldset><fieldset class="authordiv"><legend>Author '+author4+'</legend><div class="col-md-5 no-padding-right"><div class="form-group author_fn"><label for="fn'+author4+'">FN:'+author4+'</label><input type="text" class="form-control authFn txt_fn'+author4+'" moveSC="author_div" id="FN'+author4+'" name="FN['+author4+']" placeholder="FN:'+author4+'"><label id="err_txt_fn'+author4+'-err-dy" class="hide error-dy">Author name can not be same</label></div></div><div class="col-md-5 no-padding-right"><div class="form-group"><label for="ln'+author4+'">LN:'+author4+'</label><input type="text" class="form-control authLn txt_ln'+author4+'" moveSC="author_div" id="LN'+author4+'" name="LN['+author4+']" placeholder="LN:'+author4+'"><label id="err_txt_ln'+author4+'-err-dy" class="hide error-dy">Author name can not be same</label></div></div><div class="col-md-2 no-padding-right"><div class="form-group"><label for="afi'+author4+'">AFI</label><input type="text" class="form-control txt_afi'+author4+' authAfi" moveSC="author_div" id="AFI'+author4+'" name="AFI['+author4+']" placeholder="AFI"><label id="err_txt_afi'+author4+'-err-dy" class="hide error-dy">Please add value</label></div></div><div class="col-md-6 no-padding-right"><div class="form-group"><label for="aem'+author4+'">AEM</label><input type="text" class="form-control authAem txt_aem'+author4+'" moveSC="author_div" id="AEM'+author4+'" name="AEM['+author4+']" placeholder="AEM"><label id="err_txt_aem'+author4+'-err-dy" class="hide error-dy">Please select different AEM</label></div></div><div class="col-md-6 no-padding-right"><div class="form-group"><label for="aem'+author4+'">AEM</label><input type="text" class="form-control txt_aemmail'+author4+'" moveSC="author_div" id="AEMnew'+author4+'" name="AEMnew['+author4+']" placeholder="AEM"><label id="err_txt_aemmail'+author4+'-err-dy" class="hide error-dy">Please select different AEM</label></div></div>';
	
	
	
	$('#add_author').append(authHtml);
	authorCount = authorCount + 4;
	$('#author_count').val(authorCount);
}

function add_keyword() {
	var formvalue = [];
	$.ajax({
			url: "lanselectbox.php",
			type:"POST",
			data:formvalue,
			success: function(result){
				var keywordHtml = '';
				var keywordCounter1 = parseInt($('#keywordCounter').val())+1;
				var keywordCounter10 = parseInt($('#keywordCounter').val())+10;
				for(k = keywordCounter1; k<=keywordCounter10;k++){
					var copyFn = "copyConent('keyword"+k+"')";
					if(k == keywordCounter10)
						var copyFn = "copyConent('keyword"+k+"', 'lastKeyword')";
					keywordHtml = keywordHtml+'<li class="menu-item keyword'+k+'"  onclick="'+copyFn+'"><button type="button" class="menu-btn keyword1"><span class="menu-text">KeyWords:'+k+'</span> </button></li>';
				}
				$('.keywordMenu').html(keywordHtml);
				var kyWrdID = parseInt($('.keyword_fs').length)+1;
				var keywordCounter = parseInt($('#keywordCounter').val())+1;
				var KeywordDivHtml = '<fieldset class="keyword_fs"><legend>Keywords</legend>';
				if(keywordCounter1>1)
					KeywordDivHtml = KeywordDivHtml+'<div class="col-md-12"><div class="form-group"><label for="lan">LAN</label><select class="form-control  txt_lankwd" id="fs_keywprd'+kyWrdID+'" name="LANkwd1[addkey]['+kyWrdID+']" style="height: 30px !important;"><option>'+result+'</option></select><label id="fs_keywprd'+kyWrdID+'err" class="hide error-dy" for="LEN">Keyword Lan can not be repeated</label></div></div>';
				var KeywordHtml = '';
				var countAdd10 = parseInt($('#keywordCounter').val())+10
				for(i = keywordCounter; i<=countAdd10;i++){
					KeywordHtml = KeywordHtml+ '<div class="col-md-6"><div class="form-group"><label for="keywords">KeyWords:'+i+'</label><input type="text" class="keywrd form-control txt_keyword'+i+' id="KWD" name="KWD[addkey]['+i+']" placeholder="KeyWords:'+i+'"> <label id="keyword'+i+'-err-dy" class="hide error-dy" for="LEN">Please add different keyword</label></div></div>';
				}
				KeywordHtml = KeywordDivHtml+KeywordHtml+'</fieldset>';
				$('#add_keyword').append(KeywordHtml);
				$('#keywordCounter').val(countAdd10);
				
			}
	});
}
<!--PictorialData-->
$(document).ready(function(){
	var x=$(window).width();
	var y=$(window).height();
	var a=x/2.5;
$("#userForm").css('width', a+'px');
var marginLeft = parseInt(a)+50;
$('.pdfViewer').css('margin-left', marginLeft+'px');
var pageHeight =  parseInt(y)-35;
$('.ScrollStyle').css('max-height' ,pageHeight+'px');
	
	picClick = 0;
	$('#AddButton').click(function() {
		var counter = $('#photo').val();
		counter++ ;
		$('#photo').val(counter);
		$('#photo').focus();
	});
	
	$('#addcolorphoto').click( function() {
		var counter = $('#colorphoto').val();
		counter++ ;
		$('#colorphoto').val(counter);
		$('#colorphoto').focus();
	});
	$('#addcharts').click( function() {
		var counter = $('#charts').val();
		counter++ ;
		$('#charts').val(counter);
		$('#charts').focus();
	});
	$('#addacartoons').click( function() {
		var counter = $('#cartoons').val();
		counter++ ;
		$('#cartoons').val(counter);
		$('#cartoons').focus();
			
    });
	$('#adddiagrams').click( function() {
            var counter = $('#diagrams').val();
            counter++ ;
            $('#diagrams').val(counter);
			$('#diagrams').focus();
	});
	$('#addgraphs').click( function() {
            var counter = $('#graphs').val();
            counter++ ;
            $('#graphs').val(counter);
			$('#graphs').focus();
	});
	$('#addmaps').click( function() {
            var counter = $('#maps').val();
            counter++ ;
            $('#maps').val(counter);
			$('#maps').focus();
	});
});
$( "body" ).on( "change", "input, textarea", function() {
  $(this).removeClass('error-dy');
	$(this).next('label.error-dy').addClass('hide');
});

function copyConent(formDataKey, liType=0) {
$('.'+formDataKey).attr('disabled',true).addClass('disabled');
	var selectedText = window.getSelection().toString();
	var selectedText1 = selectedText.replace(/[\u00A0-\u9999<>\&]/gim, function(i) {
       return '&#'+i.charCodeAt(0)+';';
    });
	$('#selectedContentContainer').text(selectedText);
	
	
	
	var inputvalClass = 'txt_'+formDataKey;
	var selectedText = $('#selectedContentContainer').text();
	if(inputvalClass == 'txt_kwt'){
		var selectedText = $('#selectedContentContainer').text() +':';
	}
	if(liType == 'nextAuthor' || liType == 'nextAuthorAjax'){
		$('input').blur();
		if(liType == 'nextAuthorAjax'){
			$('#authorCount').val(4);
			var authorCount = 4;
		}
		else
			var authorCount = $('#authorCount').val();
		$('.authorSubLI').remove();
		var author4 = parseInt(authorCount)+4;
		var htmlAuthorLI = '';
		for(i = authorCount; i<=author4;i++){
			var authorLiType = 'author';
			if(i == author4)
				authorLiType = 'nextAuthor';
			var fn = "copyConent('fn"+i+"', '"+authorLiType+"')";
			var ln = "copyConent('ln"+i+"', '"+authorLiType+"')";
			var afi = "copyConent('afi"+i+"', '"+authorLiType+"')";
			var aem = "copyConent('aem"+i+"', '"+authorLiType+"')";
			var aemmail = "copyConent('aemmail"+i+"', '"+authorLiType+"')";
			htmlAuthorLI = htmlAuthorLI+'<li class="menu-item submenu authorSubLI"><button type="button" class="menu-btn"><span class="menu-text" id="authorMenu'+i+'">AUTHOR'+i+'</span> </button><menu class="menu"><li class="menu-item fn'+i+' authorLI" id="contextmenu_fn'+i+'" onclick="'+fn+'"><button type="button" class="menu-btn fn'+i+' authorLI"><span class="menu-text">FN'+i+'</span> </button></li><li class="menu-item ln'+i+' authorLI" onclick="'+ln+'"><button type="button" class="menu-btn ln'+i+' authorLI"><span class="menu-text">LN'+i+'</span> </button></li><li class="menu-item aem'+i+' authorLI" onclick="'+aem+'"><button type="button" class="menu-btn aem'+i+' authorLI"><span class = "menu-text">AEM1</span> </button></li><li class="menu-item aemmail'+i+' authorLI" onclick="'+aemmail+'"><button type="button" class="menu-btn aemmail'+i+' authorLI"><span class = "menu-text">AEM2</span> </button></li></menu></li>';
		}
		$('.auvLI').after(htmlAuthorLI);
		$('.'+formDataKey).attr('disabled',true).addClass('disabled');
		
			if(parseInt($('#authorCount').val()) == parseInt($('.author_fn').length)){
				$(".addAuthorBtn").trigger( "click" );
			}
			$('#authorCount').val(author4);
	}else if(liType == 'lastKeyword'){
	}
	// keywordMenuLi lastKeyword
	$('.'+inputvalClass).val(selectedText);
	$('.'+inputvalClass).blur();
	$('.'+inputvalClass).focus();
}
//function submitForm(formDataKey){
function submitForm(){
	var errorCount = 0;
	errorCount = $('.error:visible').length;
	
	if(errorCount != 0){
		$('.error:visible').first().focus();
		return false;
	}
		
	
	if(errorCount!= 0)
		$('.error').first().focus();
	$('input').removeClass('error-dy');
	//for textarea
	$('textarea').removeClass('error-dy');
	$('label.error-dy').css('display', 'none');

	//for validation on asa field
	var k;
	var asaLength = $('.asaInput').length;
	for (k = 1; k <= asaLength; k++) {
  	var asaVal = $('.asa_txt_'+k).val();
		if(asaVal != ''){
			var lastWordAsa = asaVal.substr(asaVal.length - 1); 
				if (lastWordAsa != '.') 
				{
				    $('.asa_txt_'+k).addClass('error-dy');
					$('#err_asa_txt_'+ k + '-err-dy').css('display', 'block');
					$('#err_asa_txt_'+ k + '-err-dy').removeClass('hide');
					errorCount = 1;
				}
		}
		
	}

	//validation for afi fields.
	var i;
	var afilength = $('.authAfi').length;
	for (i= 1; i<= afilength; i++) {
  	var afival = $('.txt_afi'+i).val();
		if(afival != ''){
			var re = new RegExp("^[0-9,]*$");
			//var checkAlpha = new RegExp("/^[a-zA-Z]+$/");
			if (!re.test(afival) && isNaN(afival)){
				$('.txt_afi1').addClass('error-dy');
				$('#err_txt_afi'+ i +'-err-dy').html('Please Enter Numeric and comma');				
				$('#err_txt_afi'+ i +'-err-dy').css('display', 'block');
				$('#err_txt_afi'+ i +'-err-dy').removeClass('hide');
				errorCount = 1;
			}
		}
		
	}
	//interlinked validation for AFF and AFI
		var i;
		var afilength = $('.authAfi').length;
		var afiArr = [];
		for(i= 1; i<= afilength; i++) {
			var afival = $('.txt_afi'+i).val(); //1,2
			var afival1 = afival.split(",");//1,2
				$.each(afival1, function(key,val){  // 4, 5
				if(val != '')
					afiArr.push(parseInt(val));
					var affval = $('.txt_aff'+val).val(); 
					
					if(afival !='' && typeof affval  == 'undefined'){
						$('.txt_afi'+i).addClass('error-dy');   
						$('#err_txt_afi'+ i + '-err-dy').html('AFF does not exists');				
						$('#err_txt_afi'+ i + '-err-dy').css('display', 'block');					
						$('#err_txt_afi'+ i + '-err-dy').removeClass('hide');	
						errorCount = 1; 
					}
					if(afival !='' && affval == ''){  
						$('.txt_aff'+val).addClass('error-dy'); 
						$('#err_txt_aff'+ val + '-err-dy').html('Please Add AFF value');				
						$('#err_txt_aff'+ val + '-err-dy').css('display', 'block');					
						$('#err_txt_aff'+ val + '-err-dy').removeClass('hide');	
						errorCount = 1; 
					}
				});
		} 
		
		/* check if aff value exists **/
		var afflength = $('.authAff').length;
		for(i = 1;i<= afflength; i++){
			var affval = $('.txt_aff'+i).val(); 
			if(affval != ''){
				if(afiArr.includes(i)){
					console.log('exist');
				}else{ 
					$('.txt_aff'+i).addClass('error-dy'); 
					$('#err_txt_aff'+ i + '-err-dy').html('AFI value does not exist');				
					$('#err_txt_aff'+ i + '-err-dy').css('display', 'block');					
					$('#err_txt_aff'+ i + '-err-dy').removeClass('hide');	//err_txt_aff3-err-dy
					errorCount = 1;  
				}
			}
		}
	
	/*validatin for Combination of FN and LN should be unique**/
	var countNames;
	var fnLength = $('.authFn').length; 
	var authorName = [];
 

	for (countNames = 1; countNames <= fnLength; countNames++) {

		var fnVal = $('.txt_fn'+countNames).val();
		var lnVal = $('.txt_ln'+countNames).val();
	
		/* if(fnVal == '' &&  lnVal != '' ){
		  $('.txt_fn'+countNames).addClass('error-dy');   
		  $('#err_txt_fn'+ countNames + '-err-dy').html('Please enter FN');     
		  $('#err_txt_fn'+ countNames + '-err-dy').css('display', 'block');         
		  $('#err_txt_fn'+ countNames + '-err-dy').removeClass('hide');

		  errorCount = 1;
		} */
		/* if(fnVal != ''){
			var checkAlpha = /^[a-zA-Z]+$/.test(fnVal);
			if(checkAlpha == false) {
				$('.txt_fn'+countNames).addClass('error-dy');   
				$('#err_txt_fn'+ countNames + '-err-dy').html('Only alphabets allowed.');     
				$('#err_txt_fn'+ countNames + '-err-dy').css('display', 'block');         
				$('#err_txt_fn'+ countNames + '-err-dy').removeClass('hide');
				errorCount = 1;
			}
		} */
		/* if(lnVal != ''){
			var checkAlpha = /^[a-zA-Z]+$/.test(lnVal);
			if(checkAlpha == false) {
				$('.txt_ln'+countNames).addClass('error-dy');   
				$('#err_txt_ln'+ countNames + '-err-dy').html('Only alphabets allowed.');     
				$('#err_txt_ln'+ countNames + '-err-dy').css('display', 'block');         
				$('#err_txt_ln'+ countNames + '-err-dy').removeClass('hide');
				errorCount = 1;
			}
		} */
		if(fnVal != '' &&  lnVal == '' ){
		  if(authorName.includes(fnVal)) {
			$('.txt_fn'+countNames).addClass('error-dy');         
			$('#err_txt_fn'+ countNames + '-err-dy').css('display', 'block');         
			$('#err_txt_fn'+ countNames + '-err-dy').removeClass('hide');

			errorCount = 1;
		  } else {
			authorName.push(fnVal);
		  }
		}
		if(fnVal != '' &&  lnVal != '' ) {

			if(authorName.includes(fnVal+"-"+lnVal)) {
				$('.txt_fn'+countNames).addClass('error-dy');         
				$('#err_txt_fn'+ countNames + '-err-dy').css('display', 'block');         
				$('#err_txt_fn'+ countNames + '-err-dy').removeClass('hide');

				$('.txt_ln'+countNames).addClass('error-dy');         
				$('#err_txt_ln'+ countNames + '-err-dy').css('display', 'block');         
				$('#err_txt_ln'+ countNames + '-err-dy').removeClass('hide');

				errorCount = 1;
			}else{      
				authorName.push(fnVal+"-"+lnVal); 
			} 
		}
	}
	
	
	/* validatin for AFF should be unique value **/
	var countAff;
	var afflength = $('.authAff').length;
	var affArr = [];	
	for(countAff= 1;countAff <= afflength; countAff++){
		var affval = $('.txt_aff'+countAff).val();
		//affArr.push(affval);
		if(affval != ''){
			if(affArr.includes(affval)){
				$('.txt_aff'+countAff).addClass('error-dy'); 
				$('#err_txt_aff'+ countAff + '-err-dy').html('Please Enter Different value');				
				$('#err_txt_aff'+ countAff + '-err-dy').css('display', 'block');					
				$('#err_txt_aff'+ countAff + '-err-dy').removeClass('hide');	//err_txt_aff3-err-dy
				errorCount = 1;  
			} else {
				affArr.push(affval);	
			}
		}
	}
	
	
	
	/* Validation for AEM */

	var countAem;
	var aemLength = $('.authAem').length;	
	var authorAem = [];	

	for (countAem = 1; countAem <= aemLength; countAem++) {
		var aem1Val = $('.txt_aem'+countAem).val();
		var aem2Val = $('.txt_aemmail'+countAem).val();		

		if(aem1Val =='' && aem2Val !='' ){
			$('.txt_aem'+countAem).addClass('error-dy'); 		
			$('#err_txt_aem'+ countAem + '-err-dy').html('Please enter this AEM first');		
			$('#err_txt_aem'+ countAem + '-err-dy').css('display', 'block');					
			$('#err_txt_aem'+ countAem + '-err-dy').removeClass('hide');

			errorCount = 1;
		}

		if((aem1Val !='' && aem2Val !='') || (aem1Val !='' && aem2Val =='')){

			//email validation with regular expression on AEM 1
			var re = new RegExp("^[-.\\w]+@(?![^.]{0,2}\.[a-zA-Z]{2,}$)([-a-zA-Z0-9]+\\.)+[a-zA-Z]{2,}$");
			if (!re.test(aem1Val)){
				$('.txt_aem'+countAem).addClass('error-dy');
				$('#err_txt_aem'+ countAem + '-err-dy').html('Please Enter Valid email address');                                                          
				$('#err_txt_aem'+ countAem + '-err-dy').css('display', 'block');
				$('#err_txt_aem'+ countAem + '-err-dy').removeClass('hide');
				errorCount = 1;
			}				

			//email validation with regular expression on AEM 2
			if(aem2Val !=''){
				var re = new RegExp("^[-.\\w]+@(?![^.]{0,2}\.[a-zA-Z]{2,}$)([-a-zA-Z0-9]+\\.)+[a-zA-Z]{2,}$");
				if (!re.test(aem2Val)){
					$('.txt_aemmail'+countAem).addClass('error-dy');
					$('#err_txt_aemmail'+ countAem + '-err-dy').html('Please Enter Valid email address');                                                          
					$('#err_txt_aemmail'+ countAem + '-err-dy').css('display', 'block');
					$('#err_txt_aemmail'+ countAem + '-err-dy').removeClass('hide');
					errorCount = 1;
				}				

				if(authorAem.includes(aem2Val)){

					$('.txt_aemmail'+countAem).addClass('error-dy'); 	
					$('#err_txt_aemmail'+ countAem + '-err-dy').html('Please add a different email');    					
					$('#err_txt_aemmail'+ countAem + '-err-dy').css('display', 'block');					
					$('#err_txt_aemmail'+ countAem + '-err-dy').removeClass('hide');

					errorCount = 1;
				} else {
					authorAem.push(aem2Val);	
				}
				
			}
			if(authorAem.includes(aem1Val)){
				$('.txt_aem'+countAem).addClass('error-dy'); 				
				$('#err_txt_aem'+ countAem + '-err-dy').css('display', 'block');					
				$('#err_txt_aem'+ countAem + '-err-dy').removeClass('hide');
				errorCount = 1;
			}else {
				authorAem.push(aem1Val);	
			}
		}
	}	
	
	var len = $('.txt_len').val();
	var rpn = $('.txt_rpn').val();
	var rpnTotal = 0;
	var status = true;
	if(rpn != ''){
		var rpnval = rpn.split(";");
		var status = true;
		if(rpn != ''){
			var rpnAllValue = rpnval.length;
			rpncount = 0;
			$.each(rpnval, function(key,val) {	
				var pg = $('.txt_pg').val();
				var pge = $('.txt_pge').val();
				var rpnval = val.split(",");
				var total = rpnval[1]-rpnval[0]+1; //
				rpnTotal = rpnTotal+total;
				if(parseInt(rpnval[0]) < parseInt(rpnval[1])){
					status = true;	
				}else if(/* pg == pge && */ parseInt(rpnval[0]) == parseInt(rpnval[1])){
					status = true;
					//rpncount = parseInt(rpncount)+1;
				}else{
					status = false;
				}
			
			}); 
				//return status;	
		}
			
			//if((rpnTotal != len || status == false) && rpncount != rpnAllValue){
			if((rpnTotal != len || status == false) && rpnAllValue > 1){
				$('.txt_len').addClass('error-dy');
				$('#LEN-err-dy').css('display', 'block');
				$('#LEN-err-dy').removeClass('hide');
				$('.txt_rpn').addClass('error-dy');
				$('#RPN-err-dy').css('display', 'block');
				$('#RPN-err-dy').removeClass('hide');
				errorCount = 1;
			}
			
	}
	/* lang for keyword not repeat */
		var kyLan = [];
		$( ".txt_lankwd" ).each(function( index ) {
		var lanID = $(this).attr('id');
			if(kyLan.includes($(this).val())){
					$('#'+lanID).addClass('error-dy');
					$('#'+lanID+'err').removeClass('hide');
					$('#'+lanID+'err').addClass('error-dy');
					$('#'+lanID+'err').css('display', 'block');
					$('#'+lanID).focus();
					errorCount = 1;
			  
			}else if($(this).val()){
				kyLan.push($(this).val());  
			}
		});
	/* lang for keyword not repeat */
	
	/* lang for ASA not repeat */
	var asaLan = []; 
	$( ".asaLanSelect" ).each(function( index ) {
		var lanID = $(this).attr('id');
		var lanVal = $(this).val();
		if(lanVal != ''){
			if(asaLan.includes($(this).val())){
				//fs_keywprd'+kyWrdID+'err
					$('#'+lanID).addClass('error-dy');
					$('#'+lanID+'-err-dy').removeClass('hide');
					$('#'+lanID+'-err-dy').addClass('error-dy');
					$('#'+lanID+'-err-dy').css('display', 'block');
					/* $('#err_txt_afi'+ kAfi + '-err-dy').css('display', 'block');
					$('#err_txt_afi'+ kAfi + '-err-dy').removeClass('hide'); */
					$('#'+lanID).focus();
					errorCount = 1;
			  
			}else{
				asaLan.push($(this).val());  
			}
		}
	});
		
	/* lang for ASA not repeat */
	
	/* check if keywords do not repeat for same language*/
	var kwValPresent = 0;
	for(var i = 1; i<=$('.keywrd').length;i++){
		var keywordVal = $('.txt_keyword'+i).val();
		if(keywordVal != ''){
			kwValPresent = 1;
			break;
		}
	}
	if(kwValPresent == 1){
		var keywordLanVal = $('.txt_lankwd').serializeArray();
		var keywordVal = $('.keywrd').serializeArray();
		$.ajax({
			  url: "keyword_values.php",
			  type:"POST",
			  data:{Lan:keywordLanVal, keyword: keywordVal},
			  success: function(keyWordResult){
					if(keyWordResult){
						var errorID = keyWordResult.split("**");
						var resultdataLength = errorID[0].split(",");
						$.each( resultdataLength, function( key, value ) {
							if(value){
								$('.txt_keyword'+value).addClass('error-dy');
								$('#keyword'+value+'-err-dy').text('Max length 200 allowed');
								$('#keyword'+value+'-err-dy').removeClass('hide');
								$('#keyword'+value+'-err-dy').addClass('error-dy');
								$('#keyword'+value+'-err-dy').css('display', 'block'); 
								$('.txt_keyword'+value).focus();
								errorCount = 1;
							}
						});
						var resultdata = errorID[1].split(",");
						$.each( resultdata, function( key, value ) {
							if(value){
								$('.txt_keyword'+value).addClass('error-dy');
								$('#keyword'+value+'-err-dy').text('Please add different keyword');
								$('#keyword'+value+'-err-dy').removeClass('hide');
								$('#keyword'+value+'-err-dy').addClass('error-dy');
								$('#keyword'+value+'-err-dy').css('display', 'block'); 
								$('.txt_keyword'+value).focus();
								errorCount = 1;
							}
						});
					}
				ajaxFormSumit(errorCount);
			}
		});
	}else{
			ajaxFormSumit(errorCount);
	}
	
}
function ajaxFormSumit(allErrorCount){
	if(allErrorCount!= 0){
		//$('.error-dy').first().focus();
		$('.error-dy:visible').first().focus();
	}
	else{
		var formvalue = $("form").serializeArray();
		var newArr = [];
		$.each( formvalue, function( key, value ) {
			var obj = {};
			obj.name = value.name;
			var valArr = value.value;
			var selectedText = valArr.toString();
			var selectedText = selectedText.replace(/[\u00A0-\u9999<>\&]/gim, function(i) {
			   return '&#'+i.charCodeAt(0)+';';
			});
			obj.value = selectedText;
			newArr.push(obj);
		});
		$.ajax({
			url: "createtextfile.php",
			type:"POST",
			data:newArr,
			success: function(result){
				$('li').removeClass('disabled');
				$('button').removeAttr('disabled');
				$('button').removeClass('disabled');
				var resultdata = result.split("-**-");
				var filename = resultdata[2];
				var count = resultdata[1]; 
				$(".file-success-msg").removeClass('hide');
				/*Display Message*/
					 $(".file-success-msg").css('display','block');
				  $(".file-success-msg").delay(3000).fadeOut('slow'); 
				
				//var html  = '<a style="color:#fff; text-decoration: none;" href="http://st9.idsil.com/noidaChamp/pdfViewer/pdfjs/web/'+filename+'" download> <span class="glyphicon glyphicon-download-alt" style="margin-right: 5px;"> </span>Download File</a>';
				var html  = '<a style="color:#fff; text-decoration: none;" href="<?php echo constant("DOWNLOADURL"); ?>'+filename+'" download> <span class="glyphicon glyphicon-download-alt" style="margin-right: 5px;"> </span>Download File</a>';
				
				$('.filedownload').html(html);
				$('.filedownload').removeClass('hide');
				var UI = $('.txt_ui').val();
				UISplit = UI.split("-");
				$('#signupForm input , #signupForm textarea').not('.keepValue').val('');
				
				//$('#authorCount').val(4);
				$('.keyword_fs').remove();
				$('#keywordCounter').val(0);
				$( ".addKeywordBtn" ).click();
				$('.txt_t1lan, #fs_keywprd1, #LAN').val('EN');
			//AFF
				$('.aff_div').remove();
				$('#affCounter').val(0);
				$( ".addaffBtn " ).click();
				
			//ASA
				nextAsa = 1;
				$('#add_asa').html('');
			//Author
				$('.authordiv').remove();
				 
				
				
				
				
				
				
				var authorCount = $('#authorCount').val();
				$('.authorSubLI').remove();
				var author4 = 4;
				var htmlAuthorLI = '';
				for(i = 1; i<=author4;i++){
					var authorLiType = 'author';
					if(i == author4)
						authorLiType = 'nextAuthorAjax';
					var fn = "copyConent('fn"+i+"', '"+authorLiType+"')";
					var ln = "copyConent('ln"+i+"', '"+authorLiType+"')";
					var afi = "copyConent('afi"+i+"', '"+authorLiType+"')";
					var aem = "copyConent('aem"+i+"', '"+authorLiType+"')";
					var aemmail = "copyConent('aemmail"+i+"', '"+authorLiType+"')";
					htmlAuthorLI = htmlAuthorLI+'<li class="menu-item submenu authorSubLI"><button type="button" class="menu-btn"><span class="menu-text" id="authorMenu'+i+'">AUTHOR'+i+'</span> </button><menu class="menu"><li class="menu-item fn'+i+' authorLI" id="contextmenu_fn'+i+'" onclick="'+fn+'"><button type="button" class="menu-btn fn'+i+' authorLI"><span class="menu-text">FN'+i+'</span> </button></li><li class="menu-item ln'+i+' authorLI" onclick="'+ln+'"><button type="button" class="menu-btn ln'+i+' authorLI"><span class="menu-text">LN'+i+'</span> </button></li><li class="menu-item aem'+i+' authorLI" onclick="'+aem+'"><button type="button" class="menu-btn aem'+i+' authorLI"><span class = "menu-text">AEM1</span> </button></li><li class="menu-item aemmail'+i+' authorLI" onclick="'+aemmail+'"><button type="button" class="menu-btn aemmail'+i+' authorLI"><span class = "menu-text">AEM2</span> </button></li></menu></li>';
				}
				$('.auvLI').after(htmlAuthorLI);
				
				
					
					$('#authorCount').val(0);
					
					
					$('.addAuthorBtn').click();
					/* $('.txt_ui').val(UISplit[0]+'-00'+count);
					$('.txt_rec').val('00'+count); */
				var ettValue = window.localStorage.getItem('ett_val');
				ettValue = parseInt(ettValue)+1
				window.localStorage.setItem('ett_val', ettValue);
				var ettValueInput = window.localStorage.getItem('ett_val');
				$('#RECNO').val('00'+ettValueInput);
				$('.txt_ui').val($('.txt_ui').attr('ui_value')+'-00'+ettValueInput);
			},
			
	});
	}
}
var menu = document.querySelector('.menu');
function showMenu(x, y){
	menu.style.left = x + 'px';
	menu.style.top = y + 'px';
	menu.classList.add('show-menu');
}
 function hideMenu(){
	menu.classList.remove('show-menu');
} 
function onContextMenu(e){
	e.preventDefault();
	showMenu(e.pageX, e.pageY);
	document.addEventListener('click', onClick, false);
}
function onClick(e){
	hideMenu();
	document.removeEventListener('click', onClick);
}
document.addEventListener('contextmenu', onContextMenu, false);
$(document).ready (function(){
	
	$("#errorWrapper").hide();
		
});
</script>
<script>
var input = document.getElementById( 'file-1' );
var infoArea = document.getElementById( 'file-upload-filename' );

input.addEventListener( 'change', showFileName );
function showFileName( event ) {
  // the change event gives us the input it occurred in 
  var input = event.srcElement;
  // the input has an array of files in the `files` property, each one has a name that you can use. We're just using the name here.
  var fileName = input.files[0].name;
  infoArea.textContent =  fileName;
} 
function getFileName(){
	var name = document.getElementById('fileInput'); 
	document.getElementById('file-upload-filename').innerHTML = name.files.item(0).name;
}
</script>
<script>
$('.txt_t1lan, #fs_keywprd1, #LAN').val('EN');
	  $.validator.setDefaults({
		submitHandler: function() {
			//alert("submitted!");
		}
	}); 

	 $(document).ready(function() {
		 
		var ettValueInput = window.localStorage.getItem('ett_val');
		$('#RECNO').val('00'+ettValueInput);
		$('.txt_ui').val($('.txt_ui').attr('ui_value')+'-00'+ettValueInput);
		$(".txt_pg , .txt_pge").keyup(function(){
			var pg = $('.txt_pg').val();
			var pge = $('.txt_pge').val();
			if(pg != '' && pge != ''){
				if(isNaN(pge) == true || isNaN(pg) == true){
					$('.txt_len').val('');
				}else if(pg == pge){
					$('.txt_len').val('');
				}
				else{
					$('.txt_len').val(pge-pg+1);
				}  
			}
			
		}); 
		$.validator.addMethod("notEqualTo",
			function(value, element, param) {
			var notEqual = true;
			value = $.trim(value);
			for (i = 0; i < param.length; i++) {
				if (value == $.trim($(param[i]).val())) { notEqual = false; }
			}
			return this.optional(element) || notEqual;
			},
			"Please enter a diferent value."
			);

		 $.validator.addMethod("alphabetsnspace", function(value, element) {
			return this.optional(element) || /^10./.test(value);
		}); 
		$.validator.addMethod("Endwithdot", function(value, element) {
			//return this.optional(element) || /.([^.]*)$/.test(value);
			return this.optional(element) || /\w+\s*[\.]/.test(value);
		}); 
		$.validator.addMethod("commaspace", function(value, element) {
			return this.optional(element) || /^[^,]*[^ ,][^,]*$/.test(value);
		});
		$.validator.addMethod("Notallowspace", function(value, element) {
			return this.optional(element) || /^\S*$/.test(value);
		});
		$.validator.addMethod("rpn", function(value, element) {
			//return this.optional(element) || /^\d\d?[,]\d\d?$|\d\d?[,]\d\d?$/.test(value);
			return this.optional(element) || /^\d+?[,]\d+?|\d+?[,]\d+?$/.test(value);

		});
		$.validator.addMethod("rpnvalidate", function(value, element) {
			var rpnvalue = value.split(";");
			//alert(rpnvalue);
			var status = true;
			if(value != ''){
				$.each(rpnvalue, function(key,val) {	
					var pg = $('.txt_pg').val();
					var pge = $('.txt_pge').val();
					var rpnval = val.split(",");
					//if(parseInt(rpnval[0]) < parseInt(rpnval[1]) && pg != pge){
					if(parseInt(rpnval[0]) < parseInt(rpnval[1])){
						status = true;				
						return true; 
					}else if(/* pg == pge &&  */parseInt(rpnval[0]) == parseInt(rpnval[1])){
						status = true;
						return status;
					}else{
						status = false;
						return status;
						
					}
				
						/* var rpnval = val.split(",");
						if(parseInt(rpnval[0]) < parseInt(rpnval[1])){ //x < y
							status = true; 
							return true;
						}else{
							status = false; 
							return false;
						}  */
				}); 
			}
			return status;	
		}); 
		jQuery.validator.addMethod("notEqualToEmail", function(value, element, param) {
			return this.optional(element) || value != $(param).val();
		}, "This has to be different...");
		
		$.validator.addMethod("validateemail", function(value, element) {
			return this.optional(element) || /^[-.\w]+@(?![^.]{0,2}\.[a-zA-Z]{2,}$)([-a-zA-Z0-9]+\.)+[a-zA-Z]{2,}$/.test(value);
		}); 
		 $.validator.addMethod("alphabet", function(value, element) {
			return this.optional(element) || /^[a-zA-Z0-9~@#$^*()_+=[\]{}|\\,.?: -]*$/.test(value);
			//return this.optional(element) || /^([^0-9]*)$/.test(value);
		});
		 $.validator.addMethod("uppercase", function(value, element) {
			return this.optional(element) || /^[A-Z0-9]*$/.test(value);
		});
		$.validator.addMethod("numericcomma", function(value, element) {
			return this.optional(element) || /^[0-9,]*$/.test(value);
		});
		jQuery.validator.addMethod("asa", function(value, element) {
			return this.optional(element) || /^\w+$/i.test(value);
		}, "Letters, numbers, and . only please");
		$.validator.addMethod("EndWithColon", function(value, element) {
			return this.optional(element) || /:/.test(value);
		});
		
		// validate the comment form when it is submitted
		//$("#commentForm").validate();
		//$("#submitbtn").validate();

		// validate signup form on keyup and submit
		$("#signupForm").validate({
			rules: {
				MID: {
					required: true,
					minlength: 3,
					maxlength: 4,
					uppercase: true
				},
				DY: {
					required: true,
					number: true,
					minlength: 8,
					maxlength: 8
					
				},
				RPN: {
					maxlength: 250,
					rpn:true,
					rpnvalidate:true
				},
				DOI: {
					alphabetsnspace: true,
					commaspace:true,
					Notallowspace: true
				},
				UI: {
					required: true,
					minlength: 15,
					maxlength: 17
				},
				PG: {
					required: true,
					 maxlength: 10
				},
			
				PGE: {
					required: true,
					 maxlength: 10
				},
				LEN:{
					required: true,
					maxlength: 10
				},
				TI1:{
					 required: true,
					 notEqualTo: ['#TI2', '#TI3']
				},
				TI2:{
					notEqualTo: ['#TI1', '#TI3']
				},
				TI3:{
					notEqualTo: ['#TI1', '#TI2']
				},
				TI1LAN: {
					notEqualTo: ['#TI2LAN','#TI3LAN']
				},
				TI2LAN: {
					notEqualTo: ['#TI1LAN','#TI3LAN']
				},
				TI3LAN: {
					notEqualTo: ['#TI1LAN','#TI2LAN']
				},
				AEM1: {
					validateemail:true,
					notEqualTo:['#AEM2' , '#AEM3' , '#AEM4']
				},
				AEM2: {
					validateemail:true,
					notEqualTo:['#AEM1',  '#AEM3' , '#AEM4']
				},
				AEM3: {
					validateemail:true,
					notEqualTo:['#AEM1' ,'#AEM2' ,'#AEM4']
				},
				AEM4: {
					validateemail:true,
					notEqualTo:['#AEM1' ,'#AEM2' ,'#AEM3']
				},
				/* AFI1: {
					numericcomma:true
				},
				AFI2: {
					numericcomma:true
				},
				AFI3: {
					numericcomma:true
				},
				AFI4: {
					numericcomma:true
				},*/
				/* AFF1: {
					notEqualTo: ['#AFF2','#AFF3' ,'#AFF4']
				},
				AFF2 : {
					notEqualTo: ['#AFF1','#AFF3' ,'#AFF4']
				},
				AFF3 : {
					notEqualTo: ['#AFF1','#AFF2' ,'#AFF4']
				},
				AFF4 : {
					notEqualTo: ['#AFF1','#AFF2' ,'#AFF3']
				},  */
				/* LANkwd: {
					notEqualTo:['#LAN' ,'#TI1LAN','TI2LAN','TI3LAN']
				}, */
				KWT: {
					EndWithColon:true,
					maxlength: 30
					
				},
				KWD1: {
					maxlength:200
				},
				KWD2: {
					maxlength:200
				},
				KWD3: {
					maxlength:200
				},
				KWD4: {
					maxlength:200
				},
				KWD5: {
					maxlength:200
				},
				KWD6: {
					maxlength:200
				},
				KWD7: {
					maxlength:200
				},
				KWD8: {
					maxlength:200
				},
				KWD9: {
					maxlength:200
				},
				KWD10: {
					maxlength:200
				},
				photo: {
					max: 99
				},
				colorphoto: {
					max:99
				},
				charts: {
					max:99
				},
				cartoons: {
					max:99
				},
				diagrams: {
					max:99
				},
				graphs: {
					max:99
				},
				maps: {
					max:99
				},
				agree: "required"
			},
			messages: {
				MID: {
					required: "Please enter filename",
					minlength:"MID should be Minimum 3 character length.",
					maxlength: "MID should be max 4 character length.",
					uppercase: "Please Enter only  Uppercase Character"
				},
				DY: {
					required: "Please enter date",
					number: "Please enter number",
					maxlength:"Please enter no more than 8 characters."
				},
				UI: {
					required: "Please enter date",
					minlength:"Please enter minimum 15 characters.",
					maxlength:"Please enter no more than 17characters."
				},
				lan: {
					required: "This field is required."
				},
				DOI: {
					 alphabetsnspace:"Please enter value 10.",
					 commaspace:"Not contain comma and space",
					 Notallowspace:"Not Allow Space"
				},
				PG: {
					required: "This field is required.",
					maxlength: "Please enter no more than 8 characters."
				},
				RPN: {
					max: "RPN tag cannot contain more than 250 characters.",
					rpn:"please enter x,y",
					rpnvalidate:"x is less than y e.g. 1,2;4,5;7,8;10,11"
				},
				PGE: {
					maxlength: "Please enter no more than 10 characters."
				},
				/* AFI1: {
						numericcomma:"only Numeric and comma allowed"
				},
				AFI2: {
						numericcomma:"only Numeric and comma  allowed"
				},
				AFI3: {
						numericcomma:"only Numeric and comma  allowed"
				},
				AFI4: {
						numericcomma:"only Numeric and comma  allowed"
				}, */
				AEM1: {
					validateemail: "Please enter a valid email address",
					//characters:"always ended with 2 3 characatera"
				},
				AEM2: {
					validateemail: "Please enter a valid email address"
				},
				AEM3: {
					validateemail: "Please enter a valid email address"
				},
				AEM4: {
					validateemail: "Please enter a valid email address"
				},
				FN1: {
					alphabet:"Please Enter Only Letters"
				},
				FN2: {
					alphabet:"Please Enter Only Letters"
				},
				FN3: {
					alphabet:"Please Enter Only Letters"
				},
				FN4: {
					alphabet:"Please Enter Only Letters"
				},
				KWT: {
					EndWithColon:"End with colon:",
					maxlength: "Please enter no more than 30 characters."
				},
				photo: {
					max:"Please enter a value less than or equal to 99."
				},
				email: "Please enter a valid email address",
				agree: "Please accept our policy",
				topic: "Please select at least 2 topics"
			},
			submitHandler: function(form) {
				submitForm();       
			},
		});
		// propose username by combining first- and lastname
		$("#username").focus(function() {
			var firstname = $("#firstname").val();
			var lastname = $("#lastname").val();
			if (firstname && lastname && !this.value) {
				this.value = firstname + "." + lastname;
			}
		});

		//code to hide topic selection, disable for demo
		var newsletter = $("#newsletter");
		// newsletter topics are optional, hide at first
		var inital = newsletter.is(":checked");
		var topics = $("#newsletter_topics")[inital ? "removeClass" : "addClass"]("gray");
		var topicInputs = topics.find("input").attr("disabled", !inital);
		// show when newsletter is checked
		newsletter.click(function() {
			topics[this.checked ? "removeClass" : "addClass"]("gray");
			topicInputs.attr("disabled", !this.checked);
		});
	});
	</script>
	</div>
  </body>
  
</html>
