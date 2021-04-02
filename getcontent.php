<?php

include('simple_html_dom.php');

if($_SERVER['REQUEST_METHOD'] == "GET"){

    $data = array();

    // $url = "https://granado-espada.to/index.php?forums/news-notice-and-events.7/";
    $url = "code1.php";

    if(!empty($url)){
    
        $html=file_get_html($url);
    
        if(!empty($html)){
    
            $first = $html->find('div.structItemContainer-group.js-threadList',0);
    
            $second = $first->find('div.structItem',0);
    
            $author = $second->attr['data-author'];  // data-author
    
            $title = $second->find('div.structItem-cell',1)->find('div.structItem-title',0)->find('a',0)->innertext;  //title
    
            $href = $second->find('div.structItem-cell',1)->find('div.structItem-title',0)->find('a',0)->href;  //content_href
    
            $avatarImg = $second->find('div.structItem-cell',0)->find('div.structItem-iconContainer',0)->find('a',0)->find('img',0);
            
    
            $time = $first->find('li.structItem-startDate',0)->find('a',0)->find('time',0)->innertext;
    
            $data['author'] = $author;
            $data['title'] = $title;

            if(is_object($avatarImg)){
                $avatar = $avatarImg->src;
                $data['avatar'] = "https://granado-espada.to".$avatar;
            }
            else{
                
                $data['avatar'] = "./default.png";
            }

            $data['time'] = $time;
            $data['content_href'] = $href;
        }
    }

    print_r(json_encode($data));
}




if($_SERVER['REQUEST_METHOD'] == "POST"){

    $url = $_POST['contentURL'];
   
    $html=file_get_html($url);
    if(!empty($html)){

        $first = $html->find('div.message-content.js-messageContent',0);
       
        print_r(htmlspecialchars($first));
    }
}


       
