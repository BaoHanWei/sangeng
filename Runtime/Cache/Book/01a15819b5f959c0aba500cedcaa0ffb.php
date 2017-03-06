<?php if (!defined('THINK_PATH')) exit();?><div class="content-top">
    <div class="content-top" style="padding-left: 0px;padding-top: 0px;">
        <h1><?php echo ($book_section["title"]); ?></h1>
    </div>
    <div class="content-group">
        <span id="content-head-viewcount"><i class="viewcount-icon"></i> 阅读 (<?php echo ($book_section["see"]); ?>)</span>        
        <a id="hbstar" href="javascript:;" onclick="isstar()" data-type="star">
            <i class="star-icon"></i><span>收藏</span>
        </a>
        <a class="btn-thumbs-up" href="javascript:;" onclick="islike()">
            <i class="thumbs-up-icon"></i><span id="likestatus">赞</span>(<span id="likecount">3</span>)
        </a>
    </div>
</div>
<div style="clear:both;"></div>
<div class="content-content">
    <!--<?php if(!empty($book_section["keywords"])): ?><div class="keywords">
          <?php echo L("_KEY_WORD_WITH_SPACE_"); echo ($book_section["keywords"]); ?>
        </div><?php endif; ?>
    <?php if(!empty($book_section["summary"])): ?><div class="summary">
            <blockquote>
                <p><?php echo L("_INTRODUCTION_WITH_COLON_"); echo ($book_section["summary"]); ?></p>
            </blockquote>
        </div><?php endif; ?>-->
    <?php if(!empty($book_section["content"])): ?><div class="content" style="margin-top: 15px;">
            <?php echo ($book_section["content"]); ?>
        </div><?php endif; ?>
</div>
<style>
    .zclip{
        top:24px!important;
    }
</style>
<script>
    $(function(){
        $('[data-role="copy_book_link"]').zclip({
            copy: function () {
                return $(this).attr('book-link');
            },
            afterCopy: function () {
                toast.success("<?php echo L('_COPY_SUCCESS_WITH_SINGLE_');?>");
            }
        });
    });
    $(function () {
        var interval=setInterval(function(){
            uParse('#book-content');
            clearInterval(interval);
        },100)

    })
    $(document).ready(function () {
        $('.popup-gallery').each(function () { // the containers for all your galleries
            $(this).magnificPopup({
                delegate: '.popup',
                type: 'image',
                tLoading: 'Loading image #%curr%...',
                mainClass: 'mfp-img-mobile',
                gallery: {
                    enabled: true,
                    navigateByImgClick: true,
                    preload: [0, 1] // Will preload 0 - before current, and 1 after the current image
                },
                image: {
                    tError: '<a href="%url%">The image #%curr%</a> could not be loaded.',
                    titleSrc: function (item) {
                        /*           return item.el.attr('title') + '<small>by Marsel Van Oosten</small>';*/
                        return '';
                    }
                }
            });
        });

        $('.col-xs-8>.col-xs-4').insertAfter('.col-xs-8');
    });
</script>