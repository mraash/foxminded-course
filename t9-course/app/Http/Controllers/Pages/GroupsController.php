<?php

declare(strict_types=1);

namespace App\Http\Controllers\Pages;

use Illuminate\Contracts\View\View;
use App\Domain\Repositories\GroupsRepository;
use App\Http\Requests\Pages\Groups\IndexGroupRequest;

class GroupsController extends Controller
{
    private const INDEX_PAGINATION = 8;

    public function __construct(
        private GroupsRepository $groupsRepository
    ) {
    }

    public function showIndex(IndexGroupRequest $request): View
    {
        $maxStudents = $request->getMaxStudentsInputOrNull();

        $groups = $maxStudents === null
            ? $this->groupsRepository->getPaginated(self::INDEX_PAGINATION)
            : $this->groupsRepository->getPaginatedWithLessOrEqualStudents(self::INDEX_PAGINATION, $maxStudents)
        ;

        $groups->appends($_GET);

        return $this->makeView('pages/groups/index', compact('groups'));
    }
}
