Sigue el siguiente enlace para restablecer tu contraseña: <a href="{{ $link = url('/aspirante/password/reset', $token).'?email='.urlencode($user->getEmailForPasswordReset()) }}"> {{ $link }} </a>
