<?php if(!empty($this->pendingRequests)): ?>
<div>
<div class="box"><?php echo _AT('pending_friend_requests'); ?></div>
<?php
	foreach ($this->pendingRequests as $id=>$r_obj): 
?>
<div class="contentbox">
	<ul>
	<li id="activity"><a href="mods/social/sprofile.php?id=<?php echo $id;?>"><img src="get_profile_img.php?id=<?php echo $id; ?>" alt="<?php echo _AT('profile_picture'); ?>" /></a></li>
	<li id="activity"><?php echo printSocialName($id) ?></li>
	<li id="activity"><a href="<?php echo url_rewrite('mods/social/index.php');?>?approval=y<?php echo SEP;?>id=<?php echo $r_obj->id;?>"><?php echo _AT('approve_request'); ?></a></li>
	<li id="activity"><a href="<?php echo url_rewrite('mods/social/index.php');?>?approval=n<?php echo SEP;?>id=<?php echo $r_obj->id;?>"><?php echo _AT('reject_request'); ?></a></li>
	</ul>
</div>
<?php endforeach; ?>
</div>
<?php endif; ?>

<?php if(!empty($this->groupsInvitations)): ?>
<div>
<div class="headingbox"><?php echo _AT('new_group_invitations'); ?></div>
<?php
	foreach ($this->groupsInvitations as $id=>$sender_ids): 
	$gobj = new SocialGroup($id);
	$name = '';
		foreach($sender_ids as $index=>$sender_id){
			$name .= printSocialName($sender_id).', ';
		}
	$name = substr($name, 0, -2);
?>
<div class="contentbox">
	<ul>
	<li id="activity"><?php echo _AT('has_invited_join', $name, $gobj->getID(), $gobj->getName()); ?></li>
	<li  id="activity"><?php echo _AT('accept_request'); ?><a href="mods/social/groups/invitation_handler.php?action=accept<?php echo SEP;?>id=<?php echo $gobj->getID();?>"><?php echo _AT('accept_request'); ?></a>|<a href="mods/social/groups/invitation_handler.php?action=reject<?php echo SEP;?>id=<?php echo $gobj->getID();?>"><?php echo _AT('reject_request'); ?></a></li>
	</ul>
</div>
<?php endforeach; ?>
</div>
<?php endif; ?>

<div class="">
<div class="headingbox"><a href="mods/social/connections.php"><h3><?php echo _AT('connections'); ?></h3></a></div>
<?php
/**
 * Loop through all the friends and print out a list.  
 */
if (!empty($this->friends)): ?>
	<div class="contentbox">
	<?php foreach ($this->friends as $id=>$m_obj): 
		if (is_array($m_obj) && $m_obj['added']!=1){
			//skip over members that are not "my" friends
			continue;
		} ?>
		<div class="contact_mini">
			<ul>
			<li><a href="mods/social/sprofile.php?id=<?php echo $id;?>"><?php echo printSocialProfileImg($id); ?></a></li>
			<li><?php echo printSocialName($id); ?></li>
			<li><a style="vertical-align:top;" href="<?php echo url_rewrite('mods/social/index.php');?>?remove=yes<?php echo SEP;?>id=<?php echo $id;?>"><?php echo '[x]'; ?></a></li>
			</ul>
		</div>
	<?php endforeach; ?>
	</div>
<?php else: ?>
<?php echo _AT('no_friends'); ?>
<?php endif; ?>
</div>