<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>AZKA - Vinculación de Cuenta</title>
  <style>
    * {
      box-sizing: border-box;
      margin: 0;
      padding: 0;
      font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, sans-serif;
    }

    body {
      background-color: #0b0b0e;
      color: #ffffff;
      min-height: 100vh;
      display: flex;
      flex-direction: column;
      justify-content: center;
      align-items: center;
      padding: 20px;
    }

    .header {
      text-align: center;
      margin-bottom: 24px;
    }

    .header h1 {
      font-size: 22px;
      letter-spacing: 6px;
      font-weight: 800;
      margin-bottom: 6px;
    }

    .header p {
      font-size: 11px;
      color: #6b6b76;
      letter-spacing: 3px;
      text-transform: uppercase;
    }

    .star-icon {
      color: #cc2233;
      font-size: 12px;
      margin-top: 14px;
    }

    .card {
      background-color: #121216;
      border: 1px solid #1c1c22;
      border-radius: 8px;
      padding: 36px 32px;
      width: 100%;
      max-width: 440px;
      box-shadow: 0 10px 30px rgba(0, 0, 0, 0.6);
    }

    .card h2 {
      text-align: center;
      font-size: 15px;
      letter-spacing: 2px;
      margin-bottom: 12px;
      font-weight: 700;
      text-transform: uppercase;
    }

    .card-subtitle {
      text-align: center;
      font-size: 12px;
      color: #828292;
      line-height: 1.5;
      margin-bottom: 24px;
    }

    .form-group {
      margin-bottom: 18px;
    }

    .form-group label {
      display: block;
      font-size: 10px;
      font-weight: 700;
      letter-spacing: 1.5px;
      color: #9999a6;
      margin-bottom: 8px;
      text-transform: uppercase;
    }

    .form-group input {
      width: 100%;
      padding: 12px 14px;
      background-color: #18181f;
      border: 1px solid #252530;
      border-radius: 4px;
      color: #ffffff;
      font-size: 13px;
      outline: none;
      transition: border-color 0.2s;
    }

    .form-group input::placeholder {
      color: #3f3f4c;
    }

    .form-group input:focus {
      border-color: #4a4a5a;
    }

    .btn-submit {
      width: 100%;
      padding: 14px;
      background-color: #ffffff;
      color: #000000;
      border: none;
      border-radius: 4px;
      font-weight: 800;
      font-size: 11px;
      letter-spacing: 2px;
      text-transform: uppercase;
      cursor: pointer;
      margin-top: 8px;
      margin-bottom: 12px;
      transition: opacity 0.2s;
    }

    .btn-submit:hover {
      opacity: 0.9;
    }

    .btn-recovery {
      width: 100%;
      padding: 14px;
      background: transparent;
      color: #ffffff;
      border: 1px solid #252530;
      border-radius: 4px;
      font-weight: bold;
      font-size: 11px;
      letter-spacing: 2px;
      cursor: pointer;
      margin-bottom: 24px;
      transition: border-color 0.2s, color 0.2s;
    }

    .btn-recovery:hover {
      border-color: #cc2233;
      color: #cc2233;
    }

    .counter-info {
      text-align: center;
      font-size: 11px;
      letter-spacing: 2px;
      color: #6b6b76;
      text-transform: uppercase;
    }

    .counter-info span {
      color: #ffffff;
      font-weight: bold;
    }

    .footer {
      margin-top: 30px;
      text-align: center;
      font-size: 11px;
      color: #4a4a56;
      letter-spacing: 2px;
      text-transform: uppercase;
    }
  </style>
</head>
<body>

  <div class="header">
    <h1>AZKA</h1>
    <p>STUDIO // LEALTAD</p>
    <div class="star-icon">✦</div>
  </div>

  <div class="card">
    <h2>VINCULA TU CUENTA</h2>
    <p class="card-subtitle">
      Verifica tus datos para vincular tu cuenta y quedar registrado con la familia Azka.
    </p>

    <form id="linkForm">
      <div class="form-group">
        <label for="nombre">NOMBRE</label>
        <input type="text" id="nombre" placeholder="Tu nombre" required>
      </div>

      <div class="form-group">
        <label for="correo">CORREO</label>
        <input type="email" id="correo" placeholder="correo@ejemplo.com" required>
      </div>

      <div class="form-group">
        <label for="telefono">NÚMERO DE TELÉFONO</label>
        <input type="tel" id="telefono" placeholder="0000 0000" required>
      </div>

      <button type="submit" class="btn-submit">VINCULAR CUENTA</button>
      <button type="button" class="btn-recovery" onclick="recuperarPassword()">
        RECUPERAR CONTRASEÑA
      </button>
    </form>

    <div class="counter-info">
      CÓDIGO DE VINCULACIÓN: <span id="counterDisplay">000</span>
    </div>
  </div>

  <script>
    let userCount = localStorage.getItem('azka_user_count')
      ? parseInt(localStorage.getItem('azka_user_count'))
      : 0;

    const counterDisplay = document.getElementById('counterDisplay');
    const form = document.getElementById('linkForm');

    function formatCounter(num) {
      return String(num).padStart(3, '0');
    }

    counterDisplay.textContent = formatCounter(userCount);

    form.addEventListener('submit', function(e) {
      e.preventDefault();

      alert(`¡Cuenta vinculada exitosamente con el código N.º ${formatCounter(userCount)}!`);

      userCount++;
      localStorage.setItem('azka_user_count', userCount);
      counterDisplay.textContent = formatCounter(userCount);
      form.reset();
    });

    function recuperarPassword() {
      const correo = prompt("Ingresa el correo de tu cuenta:");

      if (correo && /^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(correo)) {
        alert("Si el correo está registrado, recibirás instrucciones para recuperar tu contraseña.");
      } else if (correo !== null) {
        alert("Ingresa un correo electrónico válido.");
      }
    }
  </script>

</body>
</html>