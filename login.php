<div  class="d-flex justify-content-center" style="padding-top:15%" >
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

        

        <!-- Submit button -->
        <div class="text-center">
        <button  type="submit" id="signIn" class="btn btn-primary btn-block mb-4">Bejelentkezés </button>
        </div>

        <!-- Register buttons -->
        <div class="text-center">
            <p><a aria-current="page" href="?page=register">Regisztráció</a></p>
        </div>
    </form>
</div>


<script src="./js/login.js"></script>
<script>src="./js/cookie.js"</script>
