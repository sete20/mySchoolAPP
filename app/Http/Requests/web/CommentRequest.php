
    <?php

    namespace App\Http\Requests\Web ;
    use App\Http\Requests\Concerns\WithHashedPassword;
    use App\Rules\isValidPassword;
    use Illuminate\Foundation\Http\FormRequest;
    use Illuminate\Validation\Rules\Password;
    class CommentRequest extends FormRequest{
        use WithHashedPassword;

        public function authorize()
        {
            return true;
        }
        public function rules()
        {

            if ($this->isMethod("POST")) return $this->store();
            elseif ($this->isMethod("PUT")) return $this->update();
        }
         private function update()
        {
            return [

            ];
        }
        private function store()
        {
            return [];
        }
    }

            