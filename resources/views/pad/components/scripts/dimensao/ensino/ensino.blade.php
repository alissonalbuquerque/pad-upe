<script type="text/javascript">
    const alpha = ['A', 'B', 'C', 'D', 'E', 'F', 'G', 'H', 'I', 'J', 'K', 'L', 'M', 'N', 'O', 'P', 'Q', 'R', 'S', 'T', 'U', 'V', 'W', 'X', 'Y', 'Z'];
    
    const niveis = new Map()
    niveis.set(1, 'Graduação')
    niveis.set(2, 'Pós-graduação Stricto Sensu')
    niveis.set(3, 'Pós-Graduação Lato Sensu')

    const modalidades = new Map()
    modalidades.set(1, 'EAD')
    modalidades.set(2, 'Presencial')

    function nivel_select_options(nivel) {
        let options = '';
        
        niveis.forEach((value, index) => {
            if(nivel == index) {
                options = options + `<option selected value="${index}"> ${value} </option>`
            } else {
                options = options + `<option value="${index}"> ${value} </option>`
            }
        })

        return options;
    }

    function modalidade_select_options(modalidade) {
        let options = '';
        
        modalidades.forEach((value, index) => {
            if(modalidade == index) {
                options = options + `<option selected value="${index}"> ${value} </option>`
            } else {
                options = options + `<option value="${index}"> ${value} </option>`
            }
        })

        return options;
    }
</script>