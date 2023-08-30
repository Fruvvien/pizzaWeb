<div class="d-flex justify-content-center" style="padding-top:15%">
    <form id="loginEventListener" >
        <!-- Email input -->
        <div class="form-outline mb-4">
            <input type="email" id="email" class="form-control" />
            <label class="form-label" for="form2Example1">Email cím</label>
        </div>

        <!-- Password input -->
        <div class="form-outline mb-4">
            <input type="password" id="password" class="form-control" />
            <label class="form-label" for="form2Example2">Jelszó</label>
        </div>

        <!-- 2 column grid layout for inline styling -->
        <div class="row mb-4">
            <div class="col d-flex justify-content-center">
            <!-- Checkbox -->
            <div class="form-check">
                <input class="form-check-input" type="checkbox" value="" id="check" name="check" checked />
                <label class="form-check-label" for="form2Example31"> Emlékez rám </label>
            </div>
            </div>

        </div >

        <!-- Submit button -->
        <div class="text-center">
        <button  type="button" id="signIn" class="btn btn-primary btn-block mb-4">Bejelentkezés </button>
        </div>

        <!-- Register buttons -->
        <div class="text-center">
            <p><a href="#!">Regisztráció</a></p>
        </div>
    </form>
</div>

<script src="login.js"></script>
