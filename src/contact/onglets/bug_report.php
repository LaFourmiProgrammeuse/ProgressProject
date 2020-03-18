<link type="text/css" rel="stylesheet" href="/src/contact/onglets/css/bug_report.css" />

<div id="onglet_body">
    <h2 class="title">Bug report form</h2>
    <div class="instructions_frame">

    </div>
    <div class="form_frame">

        <form method="post" action="/src/contact/php/form_bug_report.php">

            <div class="topic">
                <p>Topic</p>
                <input type="text" name="topic" />
            </div>
            <div class="type">
                <p>Type</p>
                <select name="type">
                    <option>Functioning bug</option>
                    <option>Graphical bug</option>
                </select>
            </div>
            <div class="bug_description">
            <p>Description</p>
                <textarea name="description"></textarea>
            </div>
            <button id="bttn_send">Send</button>
        </form>
    </div>
</div>
