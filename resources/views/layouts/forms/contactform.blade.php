{!! Form::open(['route' => 'mails.send.contact', 'method' => 'POST', 'id' => 'message-form-id']) !!}

<div class="md-form">
    <i class="fa fa-user prefix"></i>
    <input type="text" id="contact-name" class="form-control validate" name="name" placeholder="Votre nom">
</div>

<div class="md-form">
    <i class="fa fa-envelope prefix"></i>
    <input type="text" id="contact-email" class="form-control" name="email" placeholder="Votre email">
</div>

<div class="md-form has-error">
    <i class="fa fa-tag prefix"></i>
    <textarea type="text" id="contact-message" class="md-textarea" name="message" placeholder="Votre message"></textarea>
</div>

<div class="text-xs-center">
    <button class="btn btn-elegant" type="submit">Envoyer</button>

    <div class="call">
        <br>
        <p>Ou préférez-vous nous appeller?
            <br>
            <span><i class="fa fa-phone"> </i></span> <b> + 04 234 123 123 </b> </p>
    </div>
</div>
{!! Form::close() !!}