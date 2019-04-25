<?php

if(!@$zona){
    $zona = 1;
}

$prev_url= base_url()."admin/".$tableName."/page-".($page-1)."?search=".$search."&zona=".$zona;
$next_url= base_url()."admin/".$tableName."/page-".($page+1)."?search=".$search."&zona=".$zona;
$hal_prev= ($page==1) ? "<li class='page-item disabled'><span class='page-link'><i class='fa fa-angle-double-left'></i></span></li>":"<li class='page-item'><a class='page-link' href=".$prev_url."><i class='fa fa-angle-double-left'></i></a></li>";
$hal_1_url= base_url()."admin/".$tableName."/page-1?search=".$search."&zona=".$zona;

$output = "$hal_prev ";
$pages = ceil($jumlahRec/$jumlahRecInPage);

$hal_next= ($page==$pages) ? "<li class='page-item disabled'><span class='page-link'><i class='fa fa-angle-double-right'></i></span></li>":"<li class='page-item'><a class='page-link' href=".$next_url."><i class='fa fa-angle-double-right'></i></a></li>";

if( isset($page)  )
{
    if( $page>$pages )
    { $output = ''; }
    else
    {
        if    ( $pages < 6       ) $start = 2;
        elseif( $page < 3        ) $start = 2;
        elseif( $page > $pages-3 ) $start = $pages - 3;
        else                       $start = $page - 1;
        if ($page==1)
            $output .= "<li class='page-item active'><a class='page-link' href='#'>1<span class='sr-only'>(current)</span></a></li>";
        else
           $output .= "<li class='page-item'><a class='page-link' href='".$hal_1_url."'>1</a></li>";

        if( $start > 2 ) $output .= "<li class='page-item disabled'><a class='page-link' href='#'>...</a></li>";

        for( $i = $start; $i < $pages; $i++ )
        {
          if ($i==$page)
            $output .= "<li class='page-item active'><a class='page-link' href='#'>".$i."<span class='sr-only'>(current)</span></a></li>";
          else
            $output .= "<li class='page-item'><a class='page-link' href='".base_url()."admin/".$tableName."/page-".$i."?search=".$search."&zona=".$zona."'>".$i."</a></li>";

            if( $i > ($start+1) ) break;
        }
        if( $start < $pages - 3 ) $output .= "<li class='page-item disabled'><a class='page-link' href='#'>...</a></li>";
        if( $pages > 1 )
            if ($page==$pages)
              $output .= "<li class='page-item active'><a class='page-link' href='#'>".$pages."<span class='sr-only'>(current)</span></a></li>";
            else
              $output .= "<li class='page-item'><a class='page-link' href='".base_url()."admin/".$tableName."/page-".$pages."?search=".$search."&zona=".$zona."'>".$pages."</a></li>";
    }
}
?>
<?php if( $output ){
	     $output .= "$hal_next ";
		 echo "<br><ul class='pagination pagination-sm'>".$output."</ul>";
		 }
	  else{
		  $output = "";
		 echo "<br><ul class='pagination pagination-sm'>".$output."</ul>";
		 }

	?>
</div>
</div>
