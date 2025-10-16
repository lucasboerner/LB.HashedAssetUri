# LB.HashedAssetUri

A tiny Neos/Flow package that provides an Eel helper to generate cache-busting URIs for static resources.

It appends a short content hash to the resource URL (as a `?v=...` query parameter), so browsers will fetch a new version whenever the file content changes, while still allowing long-lived caching for unchanged assets.

## Features

- Eel helper `HashedStaticResource` available in the default Fusion context
- Generates a content-based hash (first 10 chars of SHA-1) for the referenced static resource
- Works with localized/static resources via Neos' `StaticResourceHelper`

## Installation

Install via Composer in your Neos project:

```bash
composer require lb/neos-hashed-asset-uri
```

The package registers its Eel helper automatically via Settings.yaml, no further setup is required.

## Usage

In Fusion, use the `HashedStaticResource` helper to build the URI of a static resource with cache busting:

```fusion
prototype(Vendor.Site:Example) < prototype(Neos.Fusion:Component) {
    renderer = afx`
        <link rel="stylesheet" href={HashedStaticResource.uri('Vendor.Site', 'Public/Css/index.css')} />
        <script src={HashedStaticResource.uri('Vendor.Site', 'Public/JavaScript/index.js')}></script>
    `
}
```

Signature:

- `HashedStaticResource.uri(packageKey: string, pathAndFilename: string, localize: boolean = false): string`

Examples:

- CSS: `HashedStaticResource.uri('Vendor.Site', 'Public/Css/index.css')`
- JS: `HashedStaticResource.uri('Vendor.Site', 'Public/JavaScript/index.js')`

The generated URLs look like:

```
/_Resources/Static/Packages/Vendor.Site/Public/Css/index.css?v=1a2b3c4d5e
```
