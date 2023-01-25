<script type="text/javascript">

    function cpfMask() {
        const inputCpf = document.getElementById("user-update-cpf");
        let cpf = inputCpf.value;
        if (cpf.length > 14){
            cpf = cpf.substring(0, 14);
        } 
        console.log(cpf.length);
        cpf = cpf.replace(/\D/g, "")                    //Remove tudo o que não é dígito
        cpf = cpf.replace(/(\d{3})(\d)/, "$1.$2")       //Coloca um ponto entre o terceiro e o quarto dígitos
        cpf = cpf.replace(/(\d{3})(\d)/, "$1.$2")       //Coloca um ponto entre o terceiro e o quarto dígitos
        //de novo (para o segundo bloco de números)
        cpf = cpf.replace(/(\d{3})(\d{1,2})$/, "$1-$2") //Coloca um hífen entre o terceiro e o quarto dígitos
        inputCpf.value = cpf;
    }

</script>