<div class="heading">
        <h1>Contact <span>Us</span></h1>
    </div> 
<div class = "container">

    <form action="https://formsubmit.co/94ceadf230db037ad8dbf277dd46bf48" method="post"> 
        <label for="nome">Nome:</label> 
        <input type="text" name="nome" id="nome" required><br>

        <label for="cognome">Cognome:</label>
        <input type="text" name="cognome" id="cognome" required><br>

        <label for="telefono">Telefono:</label>
        <input type="tel" name="telefono" id="telefono" required><br>

        <label for="email">Email:</label>
        <input type="email" name="email" id="email" required><br>

        <label for="descrizione">Descrizione:</label><br>
        <textarea name="descrizione" id="descrizione" cols="30" rows="5" required></textarea><br>

        <input type="submit" value="Invia">
    </form>
</div>

<style>
.container{
    display: flex;
    margin-top: 50px;
    margin-left: 50px;
    margin-right: 50px;
    flex-direction: column;
}

label { 
    display: block; 
    margin-top: 10px; 
    font-weight: bold; 
} 
input, textarea {
    width: 100%; 
    padding: 5px; 
    margin-top: 5px; 
    border: 1px solid #ccc; 
    border-radius: 4px; 
    box-sizing: border-box; 
    font-size: 16px; 
} 
    textarea { 
        height: 100px; 
    } 
    button { 
        background-color: #4CAF50; 
        color: white; 
        border: none; 
        padding: 10px 20px; 
        text-align: center;
        margin-top: 10px; 
        margin-bottom: 10px; 
        text-decoration: none; 
        display: inline-block; 
        font-size: 16px; 
        cursor: pointer; 
        border-radius: 4px; 
    } 
    button:hover {
        background-color: #45a049; 
    } 
    .form { 
        margin: 20px auto; 
        width: 80%; 
        max-width: 600px; 
        background-color: #f2f2f2; 
        padding: 20px; 
        border-radius: 4px; 
        box-sizing: border-box; 
        box-shadow: 0px 0px 10px #ccc; 
    } 
    h1 {
    font-size: 3rem;
}
</style>