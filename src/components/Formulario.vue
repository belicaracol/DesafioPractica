<template>
    <form @submit.prevent="enviarDatos" action="formulario.php" method="post">
        <h1>Consulta Medica</h1>
        <label>Nombres</label>
        <input type="text" required v-model="nombres" v-on:keypress="sonLetras($event)" name="nombres">

        <label>Apellido Paterno</label>
        <input type="text" required v-model="paterno" v-on:keypress="sonLetras($event)" name="paterno">

        <label>Apellido Materno</label>
        <input type="text" required v-model="materno" v-on:keypress="sonLetras($event)" name="materno">

        <label>R.U.T</label>
        <input type="text" maxlength="10" required v-model="rut" v-on:keypress="sonRUT($event)" name="rut">
        <div v-if="errorRut" class="error">{{ errorRut }}</div>

        <label>Edad</label>
        <input type="number" required v-model="edad" name="edad">
        <div v-if="errorEdad" class="error">{{ errorEdad }}</div>

        <label>Sexo</label> <br>
        <select v-model="sexo">
            <option value="Masculino">Masculino</option>
            <option value="Femenino">Femenino</option>
        </select><br>

        <label>Nombre del (la) medico</label>
        <input type="text" required v-model="medico" v-on:keypress="sonLetras($event)" name="medico">

        <label>Fecha solicitud</label>
        <input type="date" placeholder="Mes/Dia/Año" required v-model="fecha" name="fecha">

        <label>Hora solicitud</label>
        <input type="time" required v-model="hora" name="hora">

        <label>E-Mail</label>
        <input type="email" required v-model="email" @blur="validateEmail" name="email">
        <div v-if="errorMail" class="error">{{ errorMail }}</div>

        <div class="agendar">
            <button>Agendar Consulta</button>
        </div>
    </form>
</template>

<script>
export default {
    data() {
        return {
            nombres: '',
            paterno: '',
            materno: '',
            rut: '',
            edad: '',
            sexo: '',
            medico: '',
            fecha: '',
            hora: '',
            email: '',
            errorEdad: '',
            errorRut: '',
            errorMail: ''
        }
    },
    methods: {
        enviarDatos(){
            if(this.edad < 18 && this.edad > 0) {
                this.errorEdad = 'Debes ser mayor de 18';
            }
            else if(this.edad <= 0){
                this.errorEdad = 'La edad debe ser mayor que 0';
            }
            else{
                this.errorEdad = '';
            }
            if(this.rut.length < 9 || this.rut.length > 10){
                this.errorRut = 'El rut debe ser 8-9 numeros, con guion';
            }
            else{
                this.errorRut = '';
            }
            if(!this.correoValido(this.email)){
                this.errorMail = 'Ingrese un email valido (ejemplo@ejemplo.com)';
            }
            else{
                this.errorMail = '';
            }
            if(this.errorEdad === "" && this.errorRut === "" && this.errorMail === "") {
                alert("Su formulario se ha recibido con exito");
            }
        },
        correoValido: function (correo) {
            var co = /^(([^<>()[\]\\.,;:\s@"]+(\.[^<>()[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
            return co.test(correo);
        },
        sonLetras(e) {
            let char = String.fromCharCode(e.keyCode);
            if(/^[A-Za-z ]+$/.test(char)) return true; 
            else e.preventDefault(); 
        },
        sonRUT(e) {
            let char = String.fromCharCode(e.keyCode);
            if(/^[0-9kK-]+$/.test(char)) return true; 
            else e.preventDefault(); 
        }
    }
}
</script>

<style>
    form{
        max-width: 420px;
        margin: 30px auto;
        background: white;
        text-align: left;
        padding: 40px;
        border-radius: 10px;
    }
    label{
        color: #aaa;
        display: inline-block;
        margin: 25px 0 15px;
        font-size: 0.6em;
        text-transform: uppercase;
        letter-spacing: 1px;
        font-weight: bold;
    }
    input{
        display: block;
        padding: 10px 6px;
        width: 100%;
        box-sizing: border-box;
        border: none;
        border-bottom: 1px solid #ddd;
        color: #555;
    }
    button{
        background: #8b6dff;
        border: 0;
        padding: 10px 20px;
        margin-top: 20px;
        color: white;
        border-radius: 20px;
        cursor:pointer;
    }

    button:hover{
        background: #8b6d78;
    }
    button:active{
        background: #8b6d99;
    }

    .agendar{
        text-align: center;
    }
    .error{
        color: #ff0062;
        margin-top: 10px;
        font-size: 0.8em;
        font-weight: bold;
    }
</style>
