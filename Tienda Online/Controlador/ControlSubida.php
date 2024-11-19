<?php
require_once '../Modelo/ProductoDAO.php';
class ControlSubida
{
    private $directorio;
    private $productoDAO;
    private $rutaCompleta;
    private $imageFileType;

    public function __construct(){
        $this->productoDAO = new ProductoDAO();
        $this->directorio = "../Recursos/Subidas/";
        if (isset($_FILES["ficheroSubida"]) && $_FILES["ficheroSubida"]["error"] === UPLOAD_ERR_OK) {
            $this->rutaCompleta = $this->directorio . basename($_FILES["ficheroSubida"]["name"]);
        }
    }
    public function mostrarDatosFichero(){
        print "Nombre de fichero: " . $_FILES['ficheroSubida']['name']."<br>";
        print "Tipo : " . $_FILES['ficheroSubida']['type'] ."<br>";
        print "Tamaño : " . $_FILES['ficheroSubida']['size'] ."<br>";
        print "Nombre temporal: " . $_FILES['ficheroSubida']['tmp_name'] ."<br>";
        print "Error : " . $_FILES['ficheroSubida']['error'] . "<br>";
        print "Ruta completa: " . $this->rutaCompleta . "<br>";
    }

    public function comprobarExiste(){
        // Check if file already exists
        if (file_exists($this->rutaCompleta)) {
            return false;
        }
        else{
            return true;
        }
    }
    public function comprobarExisteActualizar($producto){
        // Check if file already exists
        $id = $this->productoDAO->getIdProductoByName($producto->getNombre());
        $rutaAnterior = $this->productoDAO->getProductoById($id)->getImagen();
        if (file_exists($this->rutaCompleta) && ($this->rutaCompleta != $rutaAnterior)) {
            return false;
        }
        else{
            return true;
        }
    }
    public function comprobarImagen(){
        $check = getimagesize($_FILES["ficheroSubida"]["tmp_name"]);
        if ($check !== false) {
            print "File is an image - " . $check["mime"] . ".";
            $this->tipoImagen();
            return true;
        } else {
            return false;
        }
    }

    public function tipoImagen(){
        // Allow certain file formats
        if($this->imageFileType != "jpg" && $this->imageFileType != "png" && $this->imageFileType != "jpeg"
            && $this->imageFileType != "gif" ) {
            return true;
        }
        else{
            return false;
        }

    }

    public function removerFondoImagen(){
        // Ruta de la imagen
        $imagePath = $this->rutaCompleta;
        $outputPath = substr($this->rutaCompleta,0,-3).'png';  // Ruta para la nueva imagen con fondo transparente

        // Verificar el tipo de archivo de la imagen
        $imageType = exif_imagetype($imagePath); // Obtiene el tipo MIME de la imagen

        // Cargar la imagen según su tipo
        switch ($imageType) {
            case IMAGETYPE_JPEG:
                $image = imagecreatefromjpeg($imagePath);
                break;
            case IMAGETYPE_PNG:
                $image = imagecreatefrompng($imagePath);
                break;
            case IMAGETYPE_GIF:
                $image = imagecreatefromgif($imagePath);
                break;
            default:
                return false;
        }

// Obtener el color blanco (puedes cambiar este valor si el fondo es otro color)
        $white = imagecolorallocate($image, 255, 255, 255);

// Hacer transparente el color blanco
        imagecolortransparent($image, $white);

// Configurar la imagen para que guarde la transparencia (si el formato lo permite, como PNG)
        imagealphablending($image, false);
        imagesavealpha($image, true);

// Guardar la imagen con fondo transparente en formato PNG
        imagepng($image, $outputPath);

// Liberar la memoria ocupada por la imagen
        imagedestroy($image);

        return true;
    }

    public function moverImagen(){
        if (move_uploaded_file($_FILES["ficheroSubida"]["tmp_name"], $this->rutaCompleta)) {
            print "The file ". htmlspecialchars( basename( $_FILES["ficheroSubida"]["name"])). " has been uploaded.";
            return true;
        } else {
            print "Sorry, there was an error uploading your file.";
            return false;
        }
    }

    public function proceso(){
        if($this->comprobarExiste()){
            if($this->comprobarImagen()) {
                if($this->tipoImagen()){
                    if($this->moverImagen()){
                        return $this->getRutaCompleta();
                    }else{
                        return -4;
                    }
                }else {
                    return -3;
                }
            }else{
                return -2;
            }
        }else{
            return -1;
        }
    }
    public function procesoActualizar($ruta){
        if($this->comprobarExisteActualizar($ruta)){
            if($this->comprobarImagen()) {
                if($this->tipoImagen()){
                    if($this->moverImagen()){
                        return $this->getRutaCompleta();
                    }else{
                        return -4;
                    }
                }else {
                    return -3;
                }
            }else{
                return -2;
            }
        }else{
            return -1;
        }
    }
    public function getRutaCompleta(): string
    {
        return $this->rutaCompleta;
    }
}
?>