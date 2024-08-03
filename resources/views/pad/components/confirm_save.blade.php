<h3>Atenção!</h3>
<br>
<div style="display: flex; flex-direction: column; gap: 0.75rem">
    <h4>Seu PDA já está salvo no sistema.</h4>
    <h4>Ao clicar em "Sim, salvar PDA" seu PDA, em PDF, será salvo e um e-mail de confirmação será enviado.
        Se deseja alterar alguma informação importante clique em "Não, voltar para corrigir"
    </h4>
    <h4>Você aceita em continuar o salvamento e manter as informações atuais?</h4>
</div>

<div style="display: flex; width: auto; justify-content: end; gap: 1.5rem">
    <form action="{{ route('send-confirmation-email') }}" method="POST">
        @csrf
        <input type="hidden" name="user_pad_id" value="{{ $user_pad_id }}">
        <button type="submit" class="btn btn-l btn-success" data-bs-dismiss="modal">
            Sim, salvar PDA
        </button>
    </form>

    <button class="btn btn-l btn-danger" data-bs-dismiss="modal">
        Não, voltar para corrigir
    </button>
</div>

<script>
    function closeModal() {
        const modal = document.querySelector('[data-bs-dismiss="modal"]');
        if (modal) {
            const modalInstance = bootstrap.Modal.getInstance(modal.closest('.modal'));
            if (modalInstance) {
                modalInstance.hide();
            }
        }
    }
</script>
