@php
    use Nette\Utils\Json;

    $routes = [];

    foreach($divs as $div) {
        $id = $div['id'];
        $route = $div['route'];
        $routes[$id] = $route;
    }

    $routes = Json::encode($routes);
@endphp

<script type="text/javascript">

    $('#get-divs').change(function(e) {
        e.preventDefault()

        const routes = {!! $routes !!}
        const id = $(this).val()
        const btn_submit = $('#alter_task')
        const alter_task_form = $('#alter_task-form')

        if(id != '0') {
            console.log(routes[id])
            alter_task_form.attr('action', routes[id])
            btn_submit.prop('disabled', false)
        } else {
            btn_submit.prop('disabled', true)
        }
        
    }).change();
    
</script>
