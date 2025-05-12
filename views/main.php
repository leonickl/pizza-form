<style>
    label {
        display: block;
        margin: 1rem 0 0.3rem;
        font-weight: bold;
    }

    .required::after {
        content: " *";
        color: red;
    }

    input[type="text"], textarea {
        width: 100%;
        padding: 0.5rem;
        border: 1px solid #ccc;
        border-radius: 6px;
    }

    .radio-group {
        display: flex;
        flex-direction: column;
        gap: 0.75rem;
        margin-top: 0.5rem;
    }

    .radio-group label {
        display: flex;
        align-items: center;
        font-weight: normal;
        gap: 0.5rem;
        cursor: pointer;
    }

    .radio-group input[type="radio"] {
        accent-color: #3b82f6; /* optional: adds color for supported browsers */
    }

    button {
        margin-top: 1.5rem;
        padding: 0.7rem 1.5rem;
        background-color: #3b82f6;
        color: white;
        border: none;
        border-radius: 6px;
        cursor: pointer;
    }

    button:hover {
        background-color: #2563eb;
    }
</style>

<form action="/" method="post">
    <h1>Pizza bestellen</h1>

    <label for="name" class="required">Name</label>
    <input type="text" id="name" name="name" required>

    <label class="required">Pizza</label>
    <div class="radio-group">
        <label>
            <input type="radio" name="typ" value="Vegan" required>
            Vegan
        </label>
        <label>
            <input type="radio" name="typ" value="Vegetarisch">
            Vegetarisch
        </label>
        <label>
            <input type="radio" name="typ" value="Alles">
            Alles
        </label>
    </div>

    <label for="wünsche">Sonderwünsche</label>
    <textarea id="wünsche" name="wünsche" rows="4" placeholder="Optional..."></textarea>

    <button type="submit">Bestellen</button>
</form>