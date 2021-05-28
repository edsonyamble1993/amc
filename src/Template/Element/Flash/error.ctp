<style type="text/css">
.error{
background-color: #F07D52;
    padding: 16px;
    margin: 20px;
    border-left: 5px solid #A44420;
    color: white;
	}
</style>

<div class="message error" onclick="this.classList.add('hidden');"><?= h($message) ?></div>
