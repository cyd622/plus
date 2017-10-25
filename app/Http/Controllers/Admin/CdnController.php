<?php

namespace Zhiyi\Plus\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Zhiyi\Plus\Http\Controllers\Controller;
use Zhiyi\Plus\Support\Configuration as ConfigurationRepository;

class CdnController extends Controller
{
    /**
     * Get selected cdn.
     *
     * @return mixed
     * @author Seven Du <shiweidu@outlook.com>
     */
    public function getCdnSelected()
    {
        return response()->json(['seleced' => config('cdn.default')], 200);
    }

    /**
     * Get qiniu setting.
     *
     * @return mixed
     * @author Seven Du <shiweidu@outlook.com>
     */
    public function qiniu()
    {
        return response()->json([
            'domain' => config('cdn.generators.qiniu.domain'),
            'sign' => (bool) config('cdn.generators.qiniu.sign'),
            'expires' => (int) config('cdn.generators.qiniu.expires'),
            'ak' => config('cdn.generators.qiniu.ak'),
            'sk' => config('cdn.generators.qiniu.sk'),
        ], 200);
    }

    /**
     * Qiniu setting.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Zhiyi\Plus\Support\Configuration $repository
     * @author Seven Du <shiweidu@outlook.com>
     */
    public function setQiniu(Request $request, ConfigurationRepository $repository)
    {
        $repository->set([
            'cdn.default' => 'qiniu',
            'cdn.generators.filesystem.disk' => 'public',
            'cdn.generators.qiniu.domain' => $request->input('domain'),
            'cdn.generators.qiniu.sign' => (bool) $request->input('sign'),
            'cdn.generators.qiniu.expires' => (int) $request->input('expires'),
            'cdn.generators.qiniu.ak' => $request->input('ak'),
            'cdn.generators.qiniu.sk' => $request->input('sk'),
        ]);

        return response()->json(['message' => '设置成功'], 201);
    }

    /**
     * Get local disk.
     *
     * @return mixed
     * @author Seven Du <shiweidu@outlook.com>
     */
    public function getFilesystemDisk()
    {
        return response()->json(['disk' => config('cdn.generators.filesystem.disk')], 200);
    }

    /**
     * 设置本地文件系统公开磁盘.
     *
     * @param \Zhiyi\Plus\Support\Configuration $repository
     * @author Seven Du <shiweidu@outlook.com>
     */
    public function setPublicDisk(ConfigurationRepository $repository)
    {
        $repository->set([
            'cdn.default' => 'filesystem',
            'cdn.generators.filesystem.disk' => 'public',
        ]);

        return response()->json(['message' => '设置成功！'], 201);
    }

    /**
     * 获取 local 磁盘公开地址.
     *
     * @return mixed
     * @author Seven Du <shiweidu@outlook.com>
     */
    public function getLocalDisk()
    {
        return response()->json(['public' => config('cdn.generators.filesystem.public')], 200);
    }

    /**
     * 设置 local 磁盘配置.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Zhiyi\Plus\Support\Configuration $repository
     * @author Seven Du <shiweidu@outlook.com>
     */
    public function setLocalDisk(Request $request, ConfigurationRepository $repository)
    {
        $repository->set([
            'cdn.default' => 'filesystem',
            'cdn.generators.filesystem.disk' => 'local',
            'cdn.generators.filesystem.public' => $request->input('public'),
        ]);

        return response()->json(['message' => '设置成功！'], 201);
    }
}