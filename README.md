# mysql_query
  <li>gerenciador de banco de dados e facilitador de gerenciador de banco de dados
  
# instalação:
  ```shell
      $ composer require danieltm/mysql_query
  ```
  <li>Executar o composer.
    
  ## como Usar(MYSQLI)
   ```shell
     require __DIR__.'./vendor/autoload.php';
     use MysqlQuery\Master;
     $sql = new Master("host", "user", "senha");
  ``` 
  <li>importe o autoload do composer, logo apois isso use o classe de mysqlquery e instancie uma classe passando seus dados do mysql(obs bode criar uo usar colunas/values(arrays) com quaisquer elementos para simplificar eu usei apenas 2 nos exeplos. 
     
  ## como criar banco de dados(MYSQLI)
   ```shell
     $database = "nome do banco de dados";
     $sql->createDB($database);
   ```
   <li>Essa função tem o intuito de criar um banco de dados no seu servidor de mysql e rotorna true ou false
 
 ## Como deletar banco de dados(MYSQLI)
   ```shell
      $database = "nome do banco de dados";
      $sql->drodDB($database);
   ```
  <li>Essa função tem o intuito de Deletar um banco de dados no seu servidor de mysql e rotorna true ou false
    
 ## retorno de conexão(MYSQLI)
   ```shell
     $db = $sql->conexao();
   ```
 # EM DESENVOLVIMENTO...
  <li>Essa função tem o intuito de retornar a conexão para uso de querys personalizadas.
   
## Usar uma base de dados(MYSQLI)
   ```shell
     $database = "nome do banco de dados"; //o mesmo criado anteriormente(ou um ja criado)
     $sql->useDB($database);
   ```
   <li>Essa função tem o intuito de selecionar a base de dados. Ela é sempre usada antes de executar uma função da biblioteca. Caso não seja selecionada, irá retornar um erro, pois significa que a base de dados não está em uso e a função não está sendo executada. Use-a quando iniciar o código como primera função, 
logo depois  do "createDB()". 

## Criar tabela(MYSQLI)
   ```shell
      $sql->useDB($database);
      $nome_tabela = "Table_name";
      $colunas = ['coluna1', 'coluna2'];
      $type = ['varchar', 'int'];
      $sql->createTable($nome_tabela, $colunas, $type); 
   ```
  <li>Essa função tem o intuito de criar uma tabela, informando parâmetros como nome da tabela a ser criada,uma lista com os nomes das colunas e outra com os tipos de valores.
  
## Deletar tabela(MYSQLI)
   ```shell
      $sql->useDB($database);
      $nome_tabela = "Table_name";
      $sql->DropTable($nome_tabela); 
   ```
  <li>Essa função tem o intuito de Deletar uma tabela, informando parâmetros como nome da tabela a ser deletada e rotorna true ou false

## Insenrindo dados nas tabelas(MYSQLI)
   ```shell
      $sql->useDB($database); // $database é o nome da base de dados criada
      $tabela = "Table_name";
      $colunas = ['coluna1', 'coluna2'];
      $values = ['valor1', 'valor2'];
      $sql->insertDB($tabela, $colunas, $values); 
   ```
  <li>Essa função tem o intuito de inserir dados na tabela selecionada, informando parâmetros como nome da tabela, uma lista com os nomes das colunas e outra com os valores a serem inseridos na base de dados.
  
## quantidade de elementos de uma tabela(MYSQLI)
   ```shell
      $sql->useDB($database); // $database é o nome da base de dados criada
      $tabela = "Table_name";
      $colunas = ['coluna1', 'coluna2'];
      $values = ['achar1', 'achar2'];
      $sql->getCout($tabela, $colunas, $values); 
   ```
  <li>Essa função tem o intuito de achar dados na tabela selecionada, informando parâmetros como nome da tabela, uma lista com os nomes das colunas e outra com os valores a serem pesquisados e achados na base de dados e retorna true se for == 0 e se não for == 0 retorna o numero de elementos encontrados.

## pegar/mostrar todos os elementos de uma tabela(MYSQLI)
   ```shell
      $sql->useDB($database); // $database é o nome da base de dados criada
      $tabela = "Table_name";
      $lista = $sql->GetAllElements($tabela);
      foreach($lista as $key){
        echo $key[//'nome da sua coluna'];
      }
   ```
  <li>Essa função tem o intuito de pegar e retornar um array associativo com todos os elementos da tabela informada, podendo ser mostrado com um foreach ou qualqer laço de repetição que o usuario deseja;

## pegar/mostrar elementos especificos de uma tabela(MYSQLI)
  ```shell
     $sql->useDB($database); // $database é o nome da base de dados criada
     $tabela = "Table_name";
     $condição = ['ex: nome', 'senha']; // caso não informado na função ele fusba todos['*']
     $lista = $sql->GetUniqElements($tabela, ['colunas1', 'colunaN'], ['valorBuscado', 'valor2'], $condição);
  ```
  <li>Essa função tem o intuito de pegar e retornar um array associativo com os elementos especificos selecionados da tabela, informando a tabela por quais        colunas ele vai usar como buscador e os elementos que vão ser buscados podendo deixar em branco(com isso ele irá retornar todos os elementos), podendo ser  mostrado com um foreach ou qualqer laço de repetição que o usuario desejar

## Deletar elemento De uma Tabela(MYSQLI)
  ```shell
     $sql->useDB($database); // $database é o nome da base de dados criada
     $tabela = "Table_name";
     $sql->deleteUniqElement($tabela, ['coluna', 'ex: id'], ['valor', ex:1]);
  ```
  <li>Essa função tem o intuito de Deletar um elemento especifico de uma tabela passando o nome da coluna que vai ser usada como elemento de condição com o valor da coluna e irá retornar uma resposta Booleana(true/false)
    
## alterar elemento de uma tabela(row)(MYSQL)
   ```shell
      $sql->useDB($database); // $database é o nome da base de dados criada
      $tabela = "Table_name";
      $sql->alterElement($table, ['coluna', 'ex: nome'], ['valor', 'ex:daniel'], ['id', '1']);
   ```
  <li>Essa função tem o intuito de Alterar um elemento especifico de uma tabela passando o nome da coluna que vai ser alterao com o novo valor da coluna e tambem a condiçao (ex:['id', '1'] == (id=1) em query) e irá retornar uma resposta Booleana(true/false).
    
# Com PDO

## como Usar(PDO)
  ```shell
     require __DIR__.'./vendor/autoload.php';
     use MysqlQuery\Master;
     $sqlPdo = new PdoMaster("host", "senha", "tipodebanco(mysql/postgresql)", "user");
 ```
<li>importe o autoload do composer, logo apois isso use o classe de mysqlquery e instancie uma classe do PdoMaster passando seus dados do banco de dados.

## retorno de conexão(PDO)
 ```shell
     $db = $sqlPdo->conexao();
 ```
<li>Essa função tem o intuito de retornar a conexão para uso de querys personalizadas.

# EM DESENVOLVIMENTO...
