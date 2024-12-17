<style>
    #open-chat {
        background-color: #4a90e2;
        color: white;
        border: none;
        padding: 15px 30px;
        font-size: 18px;
        cursor: pointer;
        border-radius: 5px;
        transition: background-color 0.3s;
    }

    #open-chat:hover {
        background-color: #3a7bc8;
    }

    .modal {
        display: none;
        position: fixed;
        z-index: 1;
        left: 0;
        top: 0;
        width: 100%;
        height: 100%;
        background-color: rgba(0,0,0,0.4);
    }

    .modal-content {
        background-color: #fefefe;
        margin: 20vh auto;
        padding: 20px;
        border: 1px solid #888;
        width: 80%;
        max-width: 600px;
        border-radius: 10px;
        box-shadow: 0 4px 8px rgba(0,0,0,0.1);
        z-index: 100;
    }

    .close {
        color: #aaa;
        float: right;
        font-size: 28px;
        font-weight: bold;
        cursor: pointer;
    }

    .close:hover,
    .close:focus {
        color: #000;
        text-decoration: none;
        cursor: pointer;
    }

    #chat-container {
        height: 400px;
        display: flex;
        flex-direction: column;
    }

    #chat-messages {
        flex-grow: 1;
        overflow-y: auto;
        padding: 10px;
        background-color: #f9f9f9;
        border-radius: 5px;
    }

    #user-input-container {
        display: flex;
        margin-top: 10px;
    }

    #user-input {
        flex-grow: 1;
        padding: 10px;
        border: 1px solid #ddd;
        border-radius: 5px 0 0 5px;
    }

    #send-message {
        background-color: #4a90e2;
        color: white;
        border: none;
        padding: 10px 15px;
        cursor: pointer;
        border-radius: 0 5px 5px 0;
    }

    .message {
        margin-bottom: 10px;
        padding: 10px;
        border-radius: 5px;
    }

    .bot {
        background-color: #e6f2ff;
        align-self: flex-start;
    }

    .user {
        background-color: #f0f0f0;
        align-self: flex-end;
        text-align: right;
    }

    #user-form {
        margin-top: 20px;
    }

    #user-form input {
        width: 100%;
        padding: 10px;
        margin-bottom: 10px;
        border: 1px solid #ddd;
        border-radius: 5px;
    }

    #user-form button {
        background-color: #4a90e2;
        color: white;
        border: none;
        padding: 10px 15px;
        cursor: pointer;
        border-radius: 5px;
        width: 100%;
    }
</style>
<div id="chat-modal" class="modal">
    <div class="modal-content" style="background-color: #fefefe; padding: 20px; border: 1px solid #888; width: 90%; max-width: 600px; border-radius: 10px; box-shadow: 0 4px 8px rgba(0,0,0,0.1); z-index: 100;">
        <span class="close" style="color: #aaa; float: right; font-size: 28px; font-weight: bold; cursor: pointer;">&times;</span>
        <div id="chat-container" style="height: 400px; display: flex; flex-direction: column;">
            <div id="chat-messages" style="flex-grow: 1; overflow-y: auto; padding: 10px; background-color: #f9f9f9; border-radius: 5px;"></div>
            <div id="user-input-container" style="display: flex; margin-top: 10px;">
                <input type="text" id="user-input" placeholder="Escribe..." style="flex-grow: 1; padding: 10px; border: 1px solid #ddd; border-radius: 5px 0 0 5px; box-sizing: border-box;">
                <button id="send-message" style="background-color: #4a90e2; color: white; border: none; padding: 10px 15px; cursor: pointer; border-radius: 0 5px 5px 0; box-sizing: border-box;">Enviar</button>
            </div>
        </div>
        <form id="user-form" style="display: none; margin-top: 20px;">
            <h3>Por favor, proporciona tus datos:</h3>
            <input type="text" id="name" placeholder="Nombre" required style="width: 100%; padding: 10px; margin-bottom: 10px; border: 1px solid #ddd; border-radius: 5px; box-sizing: border-box;">
            <input type="email" id="email" placeholder="Correo electrónico" required style="width: 100%; padding: 10px; margin-bottom: 10px; border: 1px solid #ddd; border-radius: 5px; box-sizing: border-box;">
            <input type="tel" id="phone" placeholder="Teléfono" required style="width: 100%; padding: 10px; margin-bottom: 10px; border: 1px solid #ddd; border-radius: 5px; box-sizing: border-box;">
            <button type="submit" style="background-color: #4a90e2; color: white; border: none; padding: 10px 15px; cursor: pointer; border-radius: 5px; width: 100%; box-sizing: border-box;">Enviar datos</button>
        </form>
    </div>
</div>