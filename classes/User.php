<?php 

class UserManager extends DBManager{
    public function __costruct(){
        parent::__costruct();
        $this->tableName = 'profili';
        $this->columns = ['id_utente','nome_utente','email','nome','cognome',
        'indirizzo','civico','cap','password','telefono','iscrizione','attivo'];
    }

    public function login($email,$password){
        $result = $this->db->query("
            SELECT *
            FROM profili
            WHERE email = '$email' AND password = '$password' AND attivo = 1;
        ");

        if (count($result) > 0 ){
            $user = (object)$result[0];
            $_SESSION['user'] = $user->id_utente;
            $user = (object)[
                'id_utente' => $user->id_utente,
                'nome_utente' => $user->nome_utente,
                'email' => $user->email,
                'nome' => $user->nome,
                'cognome' => $user->cognome,
                'indirizzo' => $user->indirizzo,
                'civico' => $user->civico,
                'cap' => $user->cap,
                'password' => $user->password,
                'telefono' => $user->telefono,
                'iscrizione'=> $user->iscrizione,
                'attivo' => 1
            ];
            return true;
        }
        return false;
    
    }


    private function _setUser(){
        $user = (object)$result[0];
                $user = (object)[
                    'id_utente' => $user->id_utente,
                    'nome_utente' => $user->nome_utente,
                    'email' => $user->email,
                    'nome' => $user->nome,
                    'cognome' => $user->cognome,
                    'indirizzo' => $user->indirizzo,
                    'civico' => $user->civico,
                    'cap' => $user->cap,
                    'password' => $user->password,
                    'telefono' => $user->telefono,
                    'iscrizione'=> $user->iscrizione,
                    'attivo' => 1
                ];
    }

    public function passwordsMatch($password,$conferma_password){
        return $password == $conferma_password;
    }

    public function register($nome_utente,$email,$nome,$cognome,$indirizzo,$civico,$cap,$password, $telefono){
        $result = $this->db->query("SELECT * FROM profili WHERE email = 'email' AND attivo = 1");
        if (count($result) > 0){
            return false;
        }
        $userId = $this -> create_utente([
            'email'=>$email, 
            'password'=>$password,
            'nome_utente'=>$nome_utente,
            'nome'=>$nome,
            'cognome'=>$cognome,
            'indirizzo' =>$indirizzo,
            'civico' => $civico,
            'cap' =>$cap,
            'telefono' => $telefono
        ]);
        return $userId;
    }

    public function aggiorna($nome_utente,$email, $nome,$cognome,$indirizzo,$civico,$cap,$telefono,$encr_password){
        $result = $this->db->query("
            SELECT *
            FROM profili
            WHERE email = '$email' AND password = '$encr_password';
        ");
        if (count($result) > 0 ){
            $user = (object)$result[0];
            $this->db->execute("UPDATE profili SET nome_utente = '$nome_utente',nome = '$nome',cognome = '$cognome',indirizzo = '$indirizzo',civico = '$civico',cap = '$cap',telefono = '$telefono'
            WHERE email = '$email' AND password = '$encr_password' ");
            return true;
        }  
        else{
            return false;
        }
    }

    public function elimina($id){
        $result = $this->db->query("
            SELECT *
            FROM profili
            WHERE id_utente = $id;
        ");
        if (count($result) > 0 ){
            $this->db-> delete($id);
        }  
        else{
            return false;
        }
    }
    



    public function getDatiUtente($id_utente){
        return $this->db->query("
        SELECT profili.telefono as telefono,profili.nome_utente as utente,profili.email as email,profili.nome as nome, profili.cognome as cognome,profili.indirizzo as indirizzo,profili.civico as civico,profili.cap as cap,profili.id_utente as id_utente
        FROM profili 
        WHERE profili.id_utente = $id_utente;
        ");
    }

}

?>
