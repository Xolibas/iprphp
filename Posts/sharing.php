<?php
    function socialsharingbuttons($social='', $params=''){
        $button= '';
        switch ($social) {
         case 'facebook':
          $button='http://www.facebook.com/share.php?u='. $params['url'];
          break;
         case 'twitter':
          $button='https://twitter.com/share?url='.$params['url'].'&amp;text='. $params['title'] .'&amp;hashtags='. $params['tags'];
          break;
         case 'whatsapp':
          if(preg_match("/(android|avantgo|blackberry|bolt|boost|cricket|docomo|fone|hiptop|mini|mobi|palm|phone|pie|tablet|up\.browser|up\.link|webos|wos)/i", $_SERVER["HTTP_USER_AGENT"])){
           $button='whatsapp://send?text='. $params['url'];
          }else{
           $button='https://web.whatsapp.com/send?text='. $params['url'];
          }
          break;
         case 'linkedin':
          $button='http://www.linkedin.com/shareArticle?mini=true&amp;url='. $params['url'];
          break;
        case 'telegram':
          $button='https://telegram.me/share/url?url='. $params['url'].'&text='.$params['title'];
          break;
        default:
          break;
        }
        return $button;      
    }  
    $social='SOCIAL_TYPE';
    $params=array(
        'url'=>"http://" . $_SERVER['SERVER_NAME'] . $_SERVER['REQUEST_URI'],
        'title'=>'The best blog in the world!',
        'tags'=>'#XolibasInc #TheBestBlog'
    );

    socialsharingbuttons($social, $params); 
?>