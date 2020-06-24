    <?php
    function meta($page) {
        $meta = '<meta charset="utf-8">';
        switch ($page) {
            case 'home':
                $meta .= '<meta name="description" content="Home page description">';
                $meta .= '<meta name="keywords" content="Home page keywords">';
                break;
            case 'contact_us':
                $meta .= '<meta name="description" content="Contact us page description">';
                $meta .= '<meta name="keywords" content="Contact us page keywords">';
                break;
            default:
                $meta .= '<meta name="description" content="default page description">';
                $meta .= '<meta name="keywords" content="default page keywords">';
                break;
        }
        return $meta;
    }
?>