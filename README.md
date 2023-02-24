# mysql_query
#gerenciador de banco de dados e facilitador de gerenciador de banco de dados
  
# instalação:
  ```shell
      $ composer require danieltm/mysql_query
  ```
  Executar o composer.
  ## como Usar(MYSQLI)
   ```shell
     require __DIR__.'./vendor/autoload.php';
     use MysqlQuery\Master;
     $sql = new Master("host", "user", "senha");
  ```
   importe o autoload do composer, logo apois isso use o classe de mysqlquery e instancie uma classe passando seus dados de mysql
  ## como criar banco de dados(MYSQLI)
   ```shell
     $database = "nome do banco de dados";
     $sql->createDB($database);
   ```
   Essa função tem o intuito de criar um banco de dados no seu servidor de mysql e rotorna true ou false
 
 ## Como deletar banco de dados(MYSQLI)
    ```shell
      $database = "nome do banco de dados";
      $sql->drodDB($database);
    ```
    Essa função tem o intuito de Deletar um banco de dados no seu servidor de mysql e rotorna true ou false
    
 ## retorno de conexão(MYSQLI)
   ```shell
     $db = $sql->createDB($database);
   ```
   Essa função tem o intuito de retornar a conexão para uso de querys personalizadas.
   
## Usar uma base de dados(MYSQLI)
   ```shell
     $database = "nome do banco de dados"; //o mesmo criado anteriormente(ou um ja criado)
     $sql->useDB($database);
   ```
   Essa função tem o intuito de selecionar a base de dados. Ela é sempre usada antes de executar uma função da biblioteca. Caso não seja selecionada, irá retornar um erro, pois significa que a base de dados não está em uso e a função não está sendo executada. Use-a quando iniciar o código como primera função, 
logo depois  do "createDB()". 

## Criar tabela(MYSQLI)
   ```shell
      $sql->useDB($database)
      $nome_tabela = "Table_name";
      $colunas = ['coluna1', 'coluna2'];
      $type = ['varchar', 'int'];
      $sql->createTable($nome_tabela, $colunas, $type); 
   ```
  Essa função tem o intuito de criar uma tabela, informando parâmetros como nome da tabela a ser criada,uma lista com os nomes das colunas e outra com os tipos de valores.
  
## Deletar tabela(MYSQLI)
   ```shell
      $sql->useDB($database)
      $nome_tabela = "Table_name";
      $sql->DropTable($nome_tabela); 
   ```
  Essa função tem o intuito de Deletar uma tabela, informando parâmetros como nome da tabela a ser deletada e rotorna true ou false

## Insenrindo dados nas tabelas(MYSQLI)
   ```shell
      $sql->useDB($database) // $database é o nome da base de dados criada
      $tabela = "Table_name";
      $colunas = ['coluna1', 'coluna2'];
      $values = ['valor1', 'valor2'];
      $sql->insertDB($tabela, $colunas, $values); 
   ```
  Essa função tem o intuito de inserir dados na tabela selecionada, informando parâmetros como nome da tabela, uma lista com os nomes das colunas e outra com os valores a serem inseridos na base de dados.
  
## quantidade de elementos de uma tabela(MYSQLI)
   ```shell
      $sql->useDB($database) // $database é o nome da base de dados criada
      $tabela = "Table_name";
      $colunas = ['coluna1', 'coluna2'];
      $values = ['achar1', 'achar2'];
      $sql->getCout($tabela, $colunas, $values); 
   ```
  Essa função tem o intuito de achar dados na tabela selecionada, informando parâmetros como nome da tabela, uma lista com os nomes das colunas e outra com os valores a serem pesquisados e achados na base de dados e retorna true se for == 0 e se não for == 0 retorna o numero de elementos encontrados.
