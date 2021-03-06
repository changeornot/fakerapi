<?php
/**
 * Created by PhpStorm.
 * User: YuGang Yang
 * Date: 1/11/16
 * Time: 12:19 AM
 */

namespace App\Http\Controllers\V1;


use Api\StarterKit\Controllers\ApiController;
use Api\StarterKit\Requests\PagedRequest;
use App\Entity\Feed;
use Illuminate\Http\Request;

class FeedsController extends ApiController
{

    /**
     * @param Request $request
     * @return mixed
     */
    public function getList(Request $request)
    {

        $maxId = $this->getMaxId($request);
        $sinceId = $this->getSinceId($request);
        $limit = $this->getPageSize($request);

        $query = Feed::with('user', 'images');
        if ($maxId) {
            $query->where('id', '<', $maxId);
        } else if ($sinceId) {
            $query->where('id', '>', $sinceId);
        }

        $collection = $query->orderBy('id', 'desc')->take($limit)->get();

        return $this->respondWithCollection($collection);
    }

    /**
     * @param PagedRequest $request
     * @return mixed
     */
    public function getListWithPage(PagedRequest $request)
    {
        $perPage = $this->getPageSize($request);

        $data = Feed::with('user', 'images')
            ->orderBy('created_at', 'desc')
            ->paginate($perPage);
        return $this->respondWithPagination($data);
    }

}