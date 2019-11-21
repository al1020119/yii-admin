<?php

use common\services\UrlService;
?>
<div class="row" style="padding-bottom: 50px">
	<div class="col-lg-12">
		<span class="pagination_count" style="line-height: 40px;">共<?=$pages['total_count'];?>条记录 | 每页<?=$pages["page_size"];?>条</span>
		<ul class="pagination pagination-lg pull-right" style="margin: 0 0 ;">
			<?php if($pages['previous']): ?>
			<li><a href="<?=$url?UrlService::buildWebUrl($url,array_merge($search_conditions,[ 'p' => 1 ])):UrlService::buildNullUrl();?>" ><span>首页</span></a></li>
            <?php endif;?>
			<?php  for($page = $pages['from'];$page<=$pages['end'];$page++):?>
				<?php if($page == $pages['current']):?>
                    <li class="active"><a href="<?=UrlService::buildNullUrl();?>"><?=$page;?></a></li>
                <?php else:?>
                    <li><a href="<?=UrlService::buildWebUrl($url,array_merge($search_conditions,[ 'p' => $page ]));?>"><?=$page;?></a></li>
                <?php endif;?>
            <?php endfor;?>
			<?php if($pages['next']): ?>
			<li><a href="<?=$url?UrlService::buildWebUrl($url,array_merge($search_conditions,[ 'p' => $pages['total_page'] ])):UrlService::buildNullUrl();?>"><span>尾页</span></a></li>
            <?php endif;?>
		</ul>
	</div>
</div>