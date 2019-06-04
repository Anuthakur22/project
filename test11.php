
	

<?php
require_once('include/main1.php');
if(!isset($_SESSION['login_user'])&& $_SESSION['login_user']==''){
	header('location:index.php');
	exit;
}else{
	$id=$_SESSION['id'];	
require_once('include/header.php');	
}	
?>
<!-- Timeline content -->

    <div class="container" style="margin-top:50px;">

    	<div class="col-md-10 no-paddin-xs">

			<div class="row">

			<!-- left content-->

			<div class="profile-nav col-md-4">

				<div class="panel">

					<div class="user-heading round">

						<a href="#">

				         <?php	echo "<img src='img/Friends/".$_SESSION['image']."' />";?>

						</a>

				      <h1><?php echo $_SESSION['login_user'];?></h1>

					</div>

				</div>

				<!-- friends -->

					<div class="widget panel-friends">

						<div class="widget-header">
						
							<h3 class="widget-caption">Friends</h3>

						</div>

						<div class="widget-body bordered-top bordered-red text-center">

							<ul class="friends">
								<?php 
									$receiver_id= $_SESSION['id'];
									$receiver_status=1;
									$result= $userobj->fetchFriends($receiver_id,$receiver_status);
									if($result>0){
									foreach($result as $userdata){
								?>
								<li>
									<a href="#">
										<img src="img/Friends/<?php echo $userdata['image'];?>" title="<?php echo $userdata['sender_name'];?>" class="img-responsive tip">
									</a>
								</li>
								<?php 
									}
								}
								else{
									echo "No Friends";
								}?>					    

							</ul>

						</div>

					</div><!-- end friends -->



				<!-- People You May Know -->

				<!-- People You May Know -->

				<div class="widget">

					<div class="widget-header">

						<h3 class="widget-caption">People You May Know</h3>

					</div>

					<div class="widget-body bordered-top bordered-red">

						<div class="card">

							<div class="content">

								<ul class="list-unstyled team-members">
									<?php $result= $userobj->getFriends($table='users',$id);
									foreach($result as $userdata){										
									?>
									<li id="user_id_<?php echo $userdata['id']; ?>">
										<div class="row">

											<div class="col-xs-3">

												<div class="avatar">
											

													<img src="img/Friends/<?php echo $userdata['image'];?>" alt="Circle Image" class="img-circle img-no-padding img-responsive">

												</div>

											</div>

											<div class="col-xs-6">
                                         
												<?php echo $userdata['name'].' '.$userdata['lname'];?> 
				                           

											</div>

				            

				                        <div class="col-xs-3 text-right">
											
				                            <a href="javascript:void(0);" class="sendrequest1 btn btn-sm btn-info btn-icon" sender_id="<?php  echo $_SESSION['id'];?>" sender_name="<?php  echo $_SESSION['login_user'];?>" receiver_id="<?php echo $userdata['id'];?>" id="sendrequest1"><i class="fa fa-user-plus"></i></a>
											
				                        </div>

				                    </div>
								
				                </li>
									<?php }?>
											                            

				            </ul>

				        </div>

				    </div>					

				</div>

			</div><!-- End people yout may know -->											 			      

		</div><!-- end left content-->

			  <!-- right  content-->

				<div class="profile-info col-md-8  animated fadeInUp">
					 
					<div class="panel">

						<form  enctype="multipart/form-data" name="addPostForm" id="addPostForm" method="POST" >

							<textarea name="content" id="content" placeholder="Whats in your mind today?" rows="2" class="form-control input-lg p-text-area"></textarea>
								
							<div class="panel-footer">
								<input type="file" id="file" id="upload" name="upload[]" class="pull-left" multiple />
								<button type="button" class="btn btn-danger pull-right" value="upload" id="addPost">Post</button>
								<div class="clearfix"></div>
							</div>
													
						</form>
					</div>

					<!-- first post-->
						
					<?php 
						$where=array();
						$where=1;											
						$result= $db->getRow($table='post_files',$where);
						$tcount=count($result);
						$no_of_pages = ceil($tcount/3);
						
						$where=array();
						$where['status']=1;
						$result= $userobj->displayPost($where,$limit=3,$page_no=0);
						if($result>0){
							foreach($result as $userdata){

					?>         
						                                   
						
                             
					<div class="panel panel-white post panel-shadow" id="">

						<div class="post-heading">

							<div class="pull-left image">
								
								<?php	echo "<img class='avatar'  height='50' width='50' src='img/Friends/".$userdata['image']."' />";?> 
								
							</div>

							<div class="pull-left meta">
								<?php if($userdata['file_type']==1){?>
								<div class="title h5">
									
										
									<a href="#" class="post-user-name"><?php echo $userdata['name'];?></a>
								
									uploaded a Photo.

								</div>
								<?php } else if($userdata['file_type']==0){
								?>
								<div class="title h5">
									
										
									<a href="#" class="post-user-name"><?php echo $userdata['name'];?></a>
								
									uploaded a Video.

								</div>
								<?php } ?>

								<h6 class="text-muted time"><?php echo $userdata['date'];?></h6>

							</div>

						</div>

						<div class="post-image">
							<?php if($userdata['file_type']==1){

								echo "<img src='img/Post/".$userdata['filename']."' style='min-width: 100%;'/>"; 
							}else if($userdata['file_type']==0){
								?>
									<video width="100%" height="100%" controls>
										<source src="img/videos/<?php echo $userdata['filename']; ?>" type="video/mp4">
									</video> 
							<?php }else { } ?>
						</div>

						<div class="post-description">

							<p><?php echo $userdata['text'];?></p>

							<div class="stats">

								<a href="#" class="stat-item">

									<i class="fa fa-thumbs-up icon"></i>228

								</a>

								<a href="#" class="stat-item">

									<i class="fa fa-retweet icon"></i>128

								</a>

								<a href="#" class="stat-item">

									<i class="fa fa-comments-o icon"></i>3

								</a>

							</div>

						</div>
						
						<div class="post-footer">
							<div style="position: relative;">
								<input class="sendcomment btn btn-primary sendcommentbtn_<?php echo $userdata['post_id'];?>" value="Send" type="button" name="sendcomment" style="display:none;position: absolute;right:0px;top:0px;height:37px;" user_id="<?php  echo $_SESSION['id'];?>" post_id="<?php echo $userdata['post_id'];?>">
								<input class="form-control add-comment_<?php echo $userdata['post_id'];?> add-comment-input" placeholder="Add a comment..." type="text" name="add-comment-input" style="padding-right: 57px;" post_id="<?php echo $userdata['post_id'];?>">
							  
							</div>
							<?php 
								$post_id=$userdata['post_id'];
								$result= $userobj->displayComment($post_id);
									if($result>0){
										foreach($result as $userdata){

							?>
							<ul class="comments-list">

								<li class="comment">

									<a class="pull-left" href="#">

										<?php	echo "<img  height='25' width='25' src='img/Friends/".$userdata['image']."' />";?> 

									</a>

									<div class="comment-body">

										<div class="comment-heading">

											<h4 class="comment-user-name"><a href="#"><?php echo $userdata['name']." ".$userdata['lname'];?></a></h4>

										</div>

										<p><?php echo $userdata['comments'];?></p>

									</div>

								</li>	          
							</ul>
							<?php  }
							   }
								else{
									echo "<p class='text-center'>No comments</p>";
							}?>
						</div>

					</div><!-- first post-->
					
					<?php  }
						}else{
							 echo "No Post";
					}?>
					<input type="hidden" id="page_no" value="1">
					<input type="hidden" id="total_page_no" value="<?php echo $no_of_pages?>">
					<div id="load_data"></div>
					<div id="load_data_message">
					
					</div>
					

					      

				</div><!--end right  content-->

			</div>

    	</div>

    </div><!-- end timeline content-->



    <!-- Online users sidebar content-->

    <div class="chat-sidebar focus">

		<div class="list-group text-left">

			<p class="text-center visible-xs"><a href="#" class="hide-chat">Hide</a></p> 

			<p class="text-center chat-title">Online users</p>  

			<a href="messages.html" class="list-group-item">

			<i class="fa fa-check-circle connected-status"></i>

			<img src="img/Friends/guy-2.jpg" class="img-chat img-thumbnail">

			<span class="chat-user-name">Jeferh Smith</span>

			</a>

			<a href="messages.html" class="list-group-item">

			<i class="fa fa-times-circle absent-status"></i>

			<img src="img/Friends/woman-1.jpg" class="img-chat img-thumbnail">

			<span class="chat-user-name">Dapibus acatar</span>

			</a>

			<a href="messages.html" class="list-group-item">

			<i class="fa fa-check-circle connected-status"></i>

			<img src="img/Friends/guy-3.jpg" class="img-chat img-thumbnail">

			<span class="chat-user-name">Antony andrew lobghi</span>

			</a>

			<a href="messages.html" class="list-group-item">

			<i class="fa fa-check-circle connected-status"></i>

			<img src="img/Friends/woman-2.jpg" class="img-chat img-thumbnail">

			<span class="chat-user-name">Maria fernanda coronel</span>

			</a>

			<a href="messages.html" class="list-group-item">

			<i class="fa fa-check-circle connected-status"></i>

			<img src="img/Friends/guy-4.jpg" class="img-chat img-thumbnail">

			<span class="chat-user-name">Markton contz</span>

			</a>

			<a href="messages.html" class="list-group-item">

			<i class="fa fa-times-circle absent-status"></i>

			<img src="img/Friends/woman-3.jpg" class="img-chat img-thumbnail">

			<span class="chat-user-name">Martha creaw</span>

			</a>

			<a href="messages.html" class="list-group-item">

			<i class="fa fa-times-circle absent-status"></i>

			<img src="img/Friends/woman-8.jpg" class="img-chat img-thumbnail">

			<span class="chat-user-name">Yira Cartmen</span>

			</a>

			<a href="messages.html" class="list-group-item">

			<i class="fa fa-check-circle connected-status"></i>

			<img src="img/Friends/woman-4.jpg" class="img-chat img-thumbnail">

			<span class="chat-user-name">Jhoanath matew</span>

			</a>

			<a href="messages.html" class="list-group-item">

			<i class="fa fa-check-circle connected-status"></i>

			<img src="img/Friends/woman-5.jpg" class="img-chat img-thumbnail">

			<span class="chat-user-name">Ryanah Haywofd</span>

			</a>

			<a href="messages.html" class="list-group-item">

			<i class="fa fa-check-circle connected-status"></i>

			<img src="img/Friends/woman-9.jpg" class="img-chat img-thumbnail">

			<span class="chat-user-name">Linda palma</span>

			</a>

			<a href="messages.html" class="list-group-item">

			<i class="fa fa-check-circle connected-status"></i>

			<img src="img/Friends/woman-10.jpg" class="img-chat img-thumbnail">

			<span class="chat-user-name">Andrea ramos</span>

			</a>

			<a href="messages.html" class="list-group-item">

			<i class="fa fa-check-circle connected-status"></i>

			<img src="img/Friends/child-1.jpg" class="img-chat img-thumbnail">

			<span class="chat-user-name">Dora ty bluekl</span>
	
			</a>        

		</div>

    </div><!-- Online users sidebar content-->   

<script >
$(document).ready(function(){	
$('.sendrequest1').unbind("click").click( function(event){
	 event.preventDefault();
	var sender_id = $(this).attr('sender_id');
    var sender_name = $(this).attr('sender_name');
	var receiver_id= $(this).attr('receiver_id');
	//var that=$(this).attr('receiver_id');
	var that=$(receiver_id);
	//alert(that);
		$.ajax({
        type: 'POST',
        url: 'makefriend.php',
        data: { sid: sender_id, sname: sender_name,rid: receiver_id,sendRequest:1 },
		async: false,
        success: function(response) {
		//console.log(response);
		//alert(response);
		$('#user_id_'+receiver_id).hide();  
		if(response=='success'){
			new PNotify({
				//title: 'success',
				type:"success",			
				text: 'Request has been send',
			});
		}else{
				new PNotify({
				//title: 'success',
				type:"info",
				text: 'Request already Send',
			});
		}
		//window.location.reload();	
        }
    });
	//$('.sendrequest1').hide();
});

});

</script>
<script type="text/javascript">
            $(document).ready(function () {				
                $('#addPost').on('click', function (e) {					
					e.preventDefault();
					var form = $('#addPostForm')[0];
					var data = new FormData(form);	
					
					$.ajax({
						type: 'post',
                        url: 'upload.php', 
						data : data,
						processData:false,
						cache:false,
						async: false,
						contentType:false,
						enctype:'multipart/form-data',						                        
                        success: function (response) {   
						alert(response);
						window.location.reload();
                        },                        
                    });                 
                });
            });
</script>
<script type="text/javascript">
$(document).ready(function(){
    $(".add-comment-input").focusin(function() {
		var post_id = $(this).attr('post_id');
		$(".sendcommentbtn_"+post_id).show();		
	});	 
	
});
$(".sendcomment").on('click', function(e) {
		
		var uid = $(this).attr('user_id');
		var post_id = $(this).attr('post_id');
		var comment=$(".add-comment_"+post_id).val();
		$.ajax({
			type: 'POST',
			url: 'comment.php',
			data:{user_id:uid,post_id:post_id,comments: comment,sendRequest:1},
			success: function(response) {
				$(".sendcomment").hide();
				alert("Comment added");
				//window.location.reload();
			}
		});	
			
}); 
		
</script>
<script >
$(window).scroll(function(){
	if($(window).scrollTop() + $(window).height() > $("#load_data").height()){
		var page_no = $('#page_no').val();
		var total_page_no=$('#total_page_no').val();
		console.log(total_page_no);
		if(page_no <= total_page_no){
		displayPost(3, page_no);
		}
		
	}
});
function displayPost(limit, page_no){
	$.ajax({
		url:"fetch.php",
		method:"POST",
		async: false,
		data:{limit:limit, page_no:page_no},
		cache:false,
		success:function(data){
			$('#load_data').append(data);
			if(data == ''){
				$('#load_data_message').hide();
				action = 'active';
				return false;
			}
			else{
				var new_page_no = parseInt(parseInt(page_no)+1);
				console.log(new_page_no);
				$('#page_no').val(new_page_no);     
				action = 'inactive';
				return true;
			}
		
		}
	});
}
</script>
<?php require_once($DOC_ROOT.'include/footer.php');?>

