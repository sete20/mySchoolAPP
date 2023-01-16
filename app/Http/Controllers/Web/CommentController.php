
        <?php
        namespace App\Http\Controllers\Web;
        use App\Http\Controllers\Controller;
        use App\Models\Comment ;
        use App\Http\Requests\Web\CommentRequest;
        use App\Http\Repositories\Web\CommentRepository;

        class CommentController extends Controller{
        public function __construct(private $repository = new CommentRepository()){}

        public function __invoke(CommentRequest $request, Comment $comment)
        {
            return $this->repository->logic($request, $comment);
        }
    }
        