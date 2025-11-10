<?php if (!empty($_GET['msg'])){ ?>
<?php $mensagem = json_decode(urldecode($_GET['msg']), true); ?>
<div id="mensagem-aviso" style="
    padding: 10px 15px;
    margin-bottom: 15px;
    border-radius: 5px;
    color: white;
    background-color: <?php echo $mensagem['tipo'] === 'sucesso' ? '#003400' : '#ff6c3e' ?>;
    text-align: center;
    transition: opacity 0.5s ease;
">
    <?php echo $mensagem['texto'] ?>
</div>
<script>
    const url = new URL(window.location);
    url.searchParams.delete('msg');
    window.history.replaceState({}, document.title, url);


    setTimeout(() => {
        const msgDiv = document.getElementById('mensagem-aviso');
        if(msgDiv) {
            msgDiv.style.opacity = 0; 
            setTimeout(() => msgDiv.style.display = 'none', 500);
        }
    }, 3000);
</script>
<?php } ?>
