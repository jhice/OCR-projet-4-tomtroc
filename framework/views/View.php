<?php

/**
 * Cette classe génère les vues en fonction de ce que chaque contrôlleur lui passe en paramètre. 
 */
class View 
{
    /**
     * Le titre de la page.
     */
    private string $title;

    /**
     * Nombre de messages non lus
     */
    private int $unreadMessages;
    
    /**
     * Constructeur. 
     */
    public function __construct($title) 
    {
        $this->title = $title;
        $this->unreadMessages = Utils::getUnreadMessages();
    }
    
    /**
     * Cette méthode retourne une page complète. 
     * @param string $viewPath : le chemin de la vue demandée par le controlleur. 
     * @param array $params : les paramètres que le controlleur a envoyé à la vue.
     * @return string
     */
    public function render(string $viewName, array $params = []) : void 
    {
        // On s'occupe de la vue envoyée
        $viewPath = $this->buildViewPath($viewName);
        
        // Les deux variables ci-dessous sont utilisées dans le "main.php" qui est le template principal.
        $content = $this->_renderViewFromTemplate($viewPath, $params);
        $title = $this->title;
        $unreadMessages = $this->unreadMessages;

        // On définit les en-têtes de réponse avant envoi
        if (isset($params['errorCode'])) {
            http_response_code((int) $params['errorCode']);
        }

        ob_start();
        require(MAIN_VIEW_PATH);
        echo ob_get_clean();
    }
    
    /**
     * Coeur de la classe, c'est ici qu'est généré ce que le controlleur a demandé. 
     * @param $viewPath : le chemin de la vue demandée par le controlleur.
     * @param array $params : les paramètres que le controlleur a envoyés à la vue.
     * @throws Exception : si la vue n'existe pas.
     * @return string : le contenu de la vue.
     */
    private function _renderViewFromTemplate(string $viewPath, array $params = []) : string
    {  
        if (file_exists($viewPath)) {
            extract($params); // On transforme les diverses variables stockées dans le tableau "params" en véritables variables qui pourront être lues dans le template.
            ob_start();
            require($viewPath);
            return ob_get_clean();
        } else {
            throw new Exception("La vue '$viewPath' est introuvable.");
        }
    }

    /**
     * Cette méthode construit le chemin vers la vue demandée.
     * @param string $viewName : le nom de la vue demandée.
     * @return string : le chemin vers la vue demandée.
     */
    private function buildViewPath(string $viewName) : string
    {
        return TEMPLATE_VIEW_PATH . $viewName . '.php';
    }

    /**
     * Retourne l'emoji up ou down pour le tri monitoring
     */
    public static function getEmoji(string $column, string $sortColumn, string $sortOrder)
    {
        // Si pas la bonne colonne, on retourne vide
        if ($column !== $sortColumn) {
            return "";
        }

        // Retour emoji selon sort order
        if ($sortOrder === "asc") {
            return " ⬆️";
        }
        if ($sortOrder === "desc") {
            return " ⬇️";
        }
    }

    /**
     * Retourne la direction asc ou desc pour le tri monitoring
     */
    public static function getOrder(string $column, string $sortColumn, string $sortOrder)
    {
        // Si pas la bonne colonne, on retourne asc
        if ($column !== $sortColumn) {
            return "asc";
        }

        // Retour ordre inversé
        if ($sortOrder === "asc") {
            return "desc";
        }
        if ($sortOrder === "desc") {
            return "asc";
        }
    }
}



