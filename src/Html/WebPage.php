<?php

declare(strict_types=1);

namespace Html;

class WebPage
{
    private string $head = "";

    private string $title;

    private string $body = "";

    /**
     * Constructeur de la classe WebPage.
     * Permet d'instancier un objet ayant un title.
     * Si le title n'est pas fourni, sa valeur par défaut est : ""
     * @param string $title Le titre de la page Web
     */
    public function __construct(string $title = "")
    {
        $this->title = $title;
    }

    /**
     * Permet d'accéder au contenu d'une balise <head> d'une page Web.
     * @return string Le contenu de <head>.
     */
    public function getHead(): string
    {
        return $this->head;
    }

    /**
     * Permet d'accéder au titre de la page Web.
     * @return string Le titre de la page Web.
     */
    public function getTitle(): string
    {
        return $this->title;
    }

    /**
     * Permet de modifier le titre d'une page Web.
     * Ne retourne Rien.
     * @param string $title Le nouveau titre de la page.
     * @return void Rien.
     */
    public function setTitle(string $title): void
    {
        $this->title = $title;
    }

    /**
     * Permet d'accéder au contenu de la balise <body>.
     * @return string Le contenu de <body>.
     */
    public function getBody(): string
    {
        return $this->body;
    }

    /**
     * Permet d'ajouter du contenu à la balise <head>.
     * Ne retourne Rien.
     * @param string $content Le contenu à ajouter à <head>.
     * @return void Rien.
     */
    public function appendToHead(string $content): void
    {
        $this->head .= $content;
    }

    /**
     * Permet d'ajouter du contenu CSS à la balise <head>.
     * Ne retourne Rien.
     * @param string $css Le contenu CSS à ajouter à <head>.
     * @return void Rien.
     */
    public function appendCss(string $css): void
    {
        $this->head .= <<<HTML
        <style>$css</style>
        HTML;
    }

    /**
     * Permet d'ajouter une URL vers un fichier CSS dans la balise <head>.
     * Ne retourne Rien.
     * @param string $url L'URL vers le fichier CSS.
     * @return void Rien.
     */
    public function appendCssUrl(string $url): void
    {
        $this->head .= <<<HTML
        <link rel="stylesheet"  media="screen" href="$url">
        HTML;
    }

    /**
     * Permet d'ajouter du contenu Javascript dans la balise <head>.
     * Ne retourne Rien.
     * @param string $js Le contenu Javascript à ajouter.
     * @return void Rien.
     */
    public function appendJs(string $js): void
    {
        $this->head .= <<<HTML
        <script> $js </script>
        HTML;
    }

    /**
     * Permet d'ajouter une URL vers un fichier Js dans la balise <head>.
     * Ne retourne Rien.
     * @param string $url L'URL vers le fichier Javascript.
     * @return void Rien
     */
    public function appendJsUrl(string $url): void
    {
        $this->head .= <<<HTML
        <script src="$url"></script>
        HTML;
    }

    /**
     * Permet d'ajouter du contenu dans la balise <body>.
     * Ne retourne Rien.
     * @param string $content Le contenu à ajouter.
     * @return void Rien.
     */
    public function appendContent(string $content): void
    {
        $this->body .= $content;
    }

    /**
     * Permet de transformer le contenu des attributs de l'objet en une page HTML fonctionnelle.
     * @return string La page HTML construite.
     */
    public function toHTML(): string
    {
        $title = $this->getTitle();
        $head = $this->getHead();
        $body = $this->getBody();


        return <<<HTML
        <!DOCTYPE HTML>
        <html lang="fr">
            <head>
                <meta charset="UTF-8">
                <meta http-equiv="X-UA-Compatible" content="IE=edge">
                <meta name="viewport" content="width=device-width, initial-scale=1.0">
                <link href="https://fonts.googleapis.com/css2?family=Josefin+Sans:wght@500&display=swap" rel="stylesheet">
                <meta name="author" content="Hikari Hei'an">
                <title>$title</title>
                $head
            <body>
                $body
                <footer class="center_text">{$this -> getLastModification()}</footer>
            </body>
        </html>
        HTML;
    }

    /**
     * Permet d'éviter d'avoir des caractères qui construisent à la base une page HTML de fonctionner de la sorte.
     * Évite ainsi les problèmes de sécurité.
     * @param string $string La chaîne de caractères à protéger.
     * @return string La chaîne de caractères désormais protégée.
     */
    public function escapeString(string $string): string
    {
        return htmlspecialchars($string, ENT_QUOTES | ENT_HTML5);
    }

    /**
     * Permet de connaître la date et l'heure de la dernière modification de la page.
     * @return string La date et l'heure de la dernière modification.
     */
    public static function getLastModification(): string
    {
        $date = date("d F Y - H:i:s", getlastmod());
        return "Last modification: $date";
    }

    public function addIcon(string $url): void
    {
        $this->appendToHead(
            <<<HTML
            <link rel="icon" href="$url">
        HTML
        );
    }
}
