@php
    use Nette\Utils\Json;

    $_divs = [];

    foreach($divs as $div) {
        $id = $div['id'];
        array_push($_divs, ['id' => $id]);
    }

    $_divs = Json::encode($_divs);
@endphp

<script type="text/javascript">

    $('#get-divs').change(function(e) {
        e.preventDefault()

        const self = $(this)
        const divs = {!! $_divs !!}

        divs.forEach((div) => {
            $('#'+div.id).hide()
        })

        if(self.val() !== '0') {
            div = $('#'+self.val())
            div.show()
            form_selected = self.val()
        }

        
    }).change();
    
</script>
