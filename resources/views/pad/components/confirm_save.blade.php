<h3>Atenção</h3>
<br>
<div style="display: flex; flex-direction: column; gap: 0.75rem">
    <h4>Você está prestes a salvar seu projeto.</h4>
    <h4>Qualquer informação importante que você tenha apagado será perdida 
        e a versão atual do projeto será salva.
    </h4>
    <h4>Você aceita em continuar o salvamento e manter as informações atuais?</h4>
</div>

<div style="display: flex; width: auto; justify-content: end; gap: 1.5rem">
    <div>
        <button class="btn btn-l btn-success" 
                onclick="location.href='{{route('user-pad_pdf', ['user_pad_id' => $user_pad_id])}}'"
                data-bs-dismiss="modal">
            Sim, salvar PDA
        </button>
    </div>
    
    <button class="btn btn-l btn-danger" data-bs-dismiss="modal">
        Não, voltar para corrigir
    </button>
</div>
