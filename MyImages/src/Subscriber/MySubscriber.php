<?php declare(strict_types=1);

namespace MyImages\Subscriber;

use Shopware\Storefront\Page\GenericPageLoadedEvent;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Shopware\Core\Framework\Struct\ArrayEntity;

class MySubscriber implements EventSubscriberInterface
{
    public function __construct()
    {

    }


   public static function getSubscribedEvents(): array
    {
        // Return the events to listen to as array like this:  <event to listen to> => <method to execute>
        return [
            GenericPageLoadedEvent::class => 'onPageLoaded'
        ];
    }
    public function random_pic($dir = 'bundles/myimages')
    {
        // Initiate array which will contain the image name
        //echo "Hellooooooo";
        $imgs_arr = array();

        // Check if image directory exists
        if (file_exists($dir) && is_dir($dir) ) {

            // Get files from the directory
            $dir_arr = scandir($dir);
            $arr_files = array_diff($dir_arr, array('.','..') );

            foreach ($arr_files as $file) {
                //Get the file path
                $file_path = $dir."/".$file;
                // Get extension
                $ext = pathinfo($file_path, PATHINFO_EXTENSION);

                if ($ext=="jpg" || $ext=="png" || $ext=="JPG" || $ext=="PNG") {
                    array_push($imgs_arr, $file);
                }

            }
            $count_img_index = count($imgs_arr) - 1;
            $random_img = $imgs_arr[rand( 0, $count_img_index )];
            return $random_img;
        }
        else {
            print "Directory not found";
        }
    }
    public function onPageLoaded(GenericPageLoadedEvent $event)
    {
        // Do something
        // E.g. work with the loaded entities: $event->getEntities()
        $a = $this->random_pic();
        $b = $this->random_pic();
        $c = $this->random_pic();
        $d = $this->random_pic();
        $e = $this->random_pic();
        $array = ['key1' => $a,'key2' => $b,'key3' => $c,'key4' => $d,'key5' => $e];
        //assign the array to the page
        $event->getPage()->assign($array);

        //add the array to the page as an extension
        $event->getPage()->addExtension('testPageExtension', new ArrayEntity($array));

        //assign the array to the context
        $event->getContext()->assign($array);

        //add the array to the context as an extension
        $event->getContext()->addExtension('testContextExtension', new ArrayEntity($array));

    }
}