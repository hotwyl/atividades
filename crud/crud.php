<?php
$host = 'sh-pro32.hostgator.com.br';
$dbname = 'hg3won41_feedrss';
$user = 'hg3won41_hotwyl';
$password = 'willfrombrasil';

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $user, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Erro na conexão com o banco de dados: " . $e->getMessage());
}



/*
CREATE TABLE feeds (
    id CHAR(36) PRIMARY KEY,
    titulo VARCHAR(255) NOT NULL,
    descricao TEXT,
    url_feed VARCHAR(255) UNIQUE NOT NULL,
    url_rss VARCHAR(255) UNIQUE NOT NULL,
    categoria VARCHAR(50),
    subcategoria VARCHAR(50),
    status ENUM('ativo', 'inativo') DEFAULT 'ativo'
);
*/

class Crud {
    private $pdo;

     // Propriedades dinâmicas para validação
     private $validationRules = [
        'titulo' => ['required' => true, 'max_length' => 255],
        'descricao' => ['max_length' => 1000],
        'url' => ['required' => true, 'max_length' => 255],
        'categoria' => ['max_length' => 50],
        'subcategoria' => ['max_length' => 50],
        'status' => ['in' => ['ativo', 'inativo']],
    ];

    public function __construct(PDO $pdo) {
        $this->pdo = $pdo;
    }

    public function createFeed($data) {
        $stmt = $this->pdo->prepare('INSERT INTO feeds (id, titulo, descricao, url, categoria, subcategoria, status) VALUES (?, ?, ?, ?, ?, ?, ?, ?)');
        return $stmt->execute([$data['id'], $data['titulo'], $data['descricao'], $data['url'], $data['categoria'], $data['subcategoria'], $data['status']]);
    }

    public function readFeeds($limit = 10, $offset = 0) {
        $stmt = $this->pdo->prepare('SELECT * FROM feeds LIMIT :limit OFFSET :offset');
        $stmt->bindParam(':limit', $limit, PDO::PARAM_INT);
        $stmt->bindParam(':offset', $offset, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function listFeeds($page = 1, $perPage = 10) {
        $offset = ($page - 1) * $perPage;
        $stmt = $this->pdo->prepare('SELECT * FROM feeds LIMIT :limit OFFSET :offset');
        $stmt->bindParam(':limit', $perPage, PDO::PARAM_INT);
        $stmt->bindParam(':offset', $offset, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function showFeed($id) {
        $stmt = $this->pdo->prepare('SELECT * FROM feeds WHERE id = ?');
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function updateFeed($id, $data) {
        $stmt = $this->pdo->prepare('UPDATE feeds SET titulo = ?, descricao = ?, url = ?, categoria = ?, subcategoria = ?, status = ? WHERE id = ?');
        return $stmt->execute([$data['titulo'], $data['descricao'], $data['url'], $data['categoria'], $data['subcategoria'], $data['status'], $id]);
    }

    public function deleteFeed($id) {
        $stmt = $this->pdo->prepare('DELETE FROM feeds WHERE id = ?');
        return $stmt->execute([$id]);
    }

    public function searchFeeds($keyword, $page = 1, $perPage = 10) {
        $offset = ($page - 1) * $perPage;
        $stmt = $this->pdo->prepare('SELECT * FROM feeds WHERE titulo LIKE ? OR descricao LIKE ? OR categoria LIKE ? OR subcategoria LIKE ? LIMIT :limit OFFSET :offset');
        $keyword = "%$keyword%";
        $stmt->bindParam(':limit', $perPage, PDO::PARAM_INT);
        $stmt->bindParam(':offset', $offset, PDO::PARAM_INT);
        $stmt->execute([$keyword, $keyword, $keyword, $keyword]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Método para validar e manipular inputs
    public function handleInput($data) {
        foreach ($data as $key => $value) {
            if (property_exists($this, $key)) {
                // Utiliza métodos mágicos para obter e definir propriedades dinamicamente
                $this->$key = $value;
            }
        }

        // Realiza validação
        $validationErrors = $this->validateInputs();

        if (!empty($validationErrors)) {
            // Retorna erros de validação
            return ['success' => false, 'errors' => $validationErrors];
        }

        // Retorna sucesso e dados validados
        return ['success' => true, 'data' => $this->getValidatedData()];
    }

    // Método para validar os inputs com base nas regras definidas
    private function validateInputs() {
        $errors = [];

        foreach ($this->validationRules as $property => $rules) {
            if (isset($this->$property)) {
                $value = $this->$property;

                // Validação obrigatória
                if (isset($rules['required']) && $rules['required'] && empty($value)) {
                    $errors[$property][] = 'O campo é obrigatório.';
                }

                // Validação de comprimento máximo
                if (isset($rules['max_length']) && strlen($value) > $rules['max_length']) {
                    $errors[$property][] = 'O campo excede o comprimento máximo permitido.';
                }

                // Validação de valores permitidos
                if (isset($rules['in']) && is_array($rules['in']) && !in_array($value, $rules['in'])) {
                    $errors[$property][] = 'O valor não é permitido para este campo.';
                }
            }
        }

        return $errors;
    }

    // Método para obter os dados validados
    private function getValidatedData() {
        $data = [];

        foreach ($this->validationRules as $property => $rules) {
            if (isset($this->$property)) {
                $data[$property] = $this->$property;
            }
        }

        return $data;
    }
 
}

// Instanciar a classe Crud
$crud = new Crud($pdo);

// Identificar o método HTTP
$method = $_SERVER['REQUEST_METHOD'];

// Recebe e valida os inputs
$inputData = json_decode(file_get_contents('php://input'), true);
$result = $crud->handleInput($inputData);

// Responde com o resultado em formato JSON
echo json_encode($result);

// Responder de acordo com o método
switch ($method) {
    case 'GET':
        // Lógica para lidar com requisições GET
        if (isset($_GET['id'])) {
            // Mostrar detalhes de um feed específico
            $feed = $crud->showFeed($_GET['id']);
            echo json_encode($feed);
        } elseif (isset($_GET['search'])) {
            // Pesquisar feeds
            $keyword = $_GET['search'];
            $page = isset($_GET['page']) ? $_GET['page'] : 1;
            $perPage = isset($_GET['perPage']) ? $_GET['perPage'] : 10;
            $feeds = $crud->searchFeeds($keyword, $page, $perPage);
            echo json_encode($feeds);
        } else {
            // Listar feeds paginados
            $page = isset($_GET['page']) ? $_GET['page'] : 1;
            $perPage = isset($_GET['perPage']) ? $_GET['perPage'] : 10;
            $feeds = $crud->readFeeds($page, $perPage);
            echo json_encode($feeds);
        }
        break;
    case 'POST':
        // Lógica para lidar com requisições POST
        $postData = json_decode(file_get_contents('php://input'), true);
        $success = $crud->createFeed($postData);
        echo json_encode(['success' => $success]);
        break;
    case 'PUT':
        // Lógica para lidar com requisições PUT
        parse_str(file_get_contents('php://input'), $putData);
        $id = $_GET['id'];
        $success = $crud->updateFeed($id, $putData);
        echo json_encode(['success' => $success]);
        break;
    case 'DELETE':
        // Lógica para lidar com requisições DELETE
        $id = $_GET['id'];
        $success = $crud->deleteFeed($id);
        echo json_encode(['success' => $success]);
        break;
    default:
        header('HTTP/1.1 405 Method Not Allowed');
        echo json_encode(['error' => 'Method Not Allowed']);
        break;
}

?>
