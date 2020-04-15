# Markdown Puller
This php class is used to fetch documentation from github for various websites including [support.econjobmarket.org](https://support.econjobmarket.org) and [backend.econjobmarket.org](https://backend.econjobmarket.org).

It is a very simple class that needs two pieces of information.  The first is a github url that points to a markdown file on github.  

The second is a github user agent, typically your repository name on github.

For example, to refer to the url [https://github.com/econjobmarket/api_documentation/blob/master/api/Api-Documents.0.md](https://github.com/econjobmarket/api_documentation/blob/master/api/Api-Documents.0.md) you would use the base url

```
https://api.github.com/repos/econjobmarket/api_documentation/contents
```
Note that this isn't the same url as the public url above.

Next step is to add the specific file information assocated with the public url. This involves the directory within the repository `api`, then the filename `Api-Documents.0.md`.  This would make the url that you provide the github client 
```
https://api.github.com/repos/econjobmarket/api_documentation/contents/api/Api-Documents.0.md
```
You can test with using either curl or wget.  The response with wget is
```
{
  "name": "Api-Documents.0.md",
  "path": "api/Api-Documents.0.md",
  "sha": "65df7bd07a5ca1b61a9f0ddede998d73991e660b",
  "size": 1445,
  "url": "https://api.github.com/repos/econjobmarket/api_documentation/contents/api/Api-Documents.0.md?ref=master",
  "html_url": "https://github.com/econjobmarket/api_documentation/blob/master/api/Api-Documents.0.md",
  "git_url": "https://api.github.com/repos/econjobmarket/api_documentation/git/blobs/65df7bd07a5ca1b61a9f0ddede998d73991e660b",
  "download_url": "https://raw.githubusercontent.com/econjobmarket/api_documentation/master/api/Api-Documents.0.md",
  "type": "file",
  "content": "QWNjZXNzIHRvIHRoZSBhcGkgaXMgYXZhaWxhYmxlIGF0IFtodHRwczovL2Jh\nY2tlbmQuZWNvbmpvYm1hcmtldC5vcmddKGh0dHBzOi8vYmFja2VuZC5lY29u\nam9ibWFya2V0Lm9yZykuICBJZiB5b3Ugd2lzaCB0byB0ZXN0IHRoZSBhcGkg\nYW5kIHVzZSBpdCB5b3Ugd2lsbCBuZWVkIHRvIGdvIHRoZXJlIGFuZCBsb2dp\nbiB3aXRoIGVjb25qb2JtYXJrZXQuICBPbmNlIHlvdSBoYXZlIGxvZ2dlZCBp\nbiwgdXNlIHRoZSBsaW5rIHRoYXQgc2F5cyAiRWptIGFwaSBEZXRhaWxzIGZv\nciB5b3VyIE9yZ2FuaXphdGlvbiIuICBUaGUgZGV0YWlscyB5b3UgbmVlZCB0\nbyB1c2UgdGhlIGFwaSB3aWxsIGFwcGVhciB1bmxlc3MgeW91IGFyZSBhdCBm\naXJzdCBsb2dpbi4gIEluIHRoYXQgY2FzZSBjbGljayB0aGUgIkdldCBTdGFy\ndGVkIiBidXR0b24uICBZb3VyIGtleXMgd2lsbCBiZSBjcmVhdGVkLCBhbmQg\neW91IHdpbGwgbmVlZCB0byBlbnRlciB0aGUgaXBhZGRyZXNzZXMgb2YgdGhl\nIGNvbXB1dGVycyB0aGF0IHdpbGwgYWNjZXNzIHRoZSBhcGkuCgpBcyBvZiBK\ndWx5LCAyMDE4LCBhcHBsaWNhbnQgZGF0YSBpcyBkZWxpdmVyZWQgYnkgYSBz\naW1wbGVyIGFwaSB3aGljaCBpcyBkb2N1bWVudGVkIGhlcmUuICBUaGUgb2xk\nZXIgYXBpIGlzIGRlc2NyaWJlZCBhdCBbaHR0cHM6Ly9iYWNrZW5kLmVjb25q\nb2JtYXJrZXQub3JnL2xlZ2FjeV0oaHR0cHM6Ly9iYWNrZW5kLmVjb25qb2Jt\nYXJrZXQub3JnL2xlZ2FjeSkuCgpGZWF0dXJlcyBvZiB0aGUgbmV3IGFwaSBp\nbmNsdWRlOgoKMS4gUmVhbCB0aW1lIGRhdGEgKG5vIGNhY2hpbmcpLgoyLiBB\ndXRoZW50aWNhdGlvbiBieSBvYXV0aC4KMy4gT25seSBmaXZlIG1ldGhvZHMs\nIGFwcGxpY2FudCwgYXBwbGljYXRpb25zLCBmaWxlcywgbGV0dGVycywgYW5k\nIGludGVydmlld3MuCjQuIEFwcGxpY2F0aW9uIHRva2VucyBjYW4gYmUgdXNl\nZCB0byBmZXRjaCBpbmZvcm1hdGlvbiBhbmQgbGV0dGVycy4KCklmIHlvdSBh\ncmUgdXNpbmcgdGhlIG9sZGVyIGFwaSwgcHJlIEp1bHkgMjAxOCwgZm9sbG93\nIHRoZSBMZWdhY3kgQXBpIGxpbmsgb24gdGhlIHJpZ2h0IG1lbnUuICAKCi0g\nW0dldHRpbmcgU3RhcnRlZF0oR2V0dGluZy1TdGFydGVkLjEubWQpCi0gW1Vz\naW5nIE9hdXRoIGFuZCBhY2Nlc3MgdG9rZW5zXShBdXRoZW50aWNhdGlvbi1h\nbmQtQWNjZXNzLVRva2Vucy4yLm1kKQotIE1ldGhvZHMKICAxLiBbYXBwbGlj\nYXRpb25zXShBcHBsaWNhdGlvbi1NZXRob2QuMy5tZCkKICAyLiBbYXBwbGlj\nYW50c10oQXBwbGljYW50LU1ldGhvZC40Lm1kKQogIDMuIFtGaWxlc10oRmls\nZXMtTWV0aG9kLjUubWQpCiAgNC4gW0xldHRlcnNdKFJlY29tbWVuZGF0aW9u\nLUxldHRlcnMuNi5tZCkKICA2LiBbRG9jdW1lbnQgbWV0aG9kXShEb2N1bWVu\ndC1NZXRob2QuNy5tZCkKICA1LiBbSW50ZXJ2aWV3c10oSW50ZXJ2aWV3cy44\nLm1kKQo=\n",
  "encoding": "base64",
  "_links": {
    "self": "https://api.github.com/repos/econjobmarket/api_documentation/contents/api/Api-Documents.0.md?ref=master",
    "git": "https://api.github.com/repos/econjobmarket/api_documentation/git/blobs/65df7bd07a5ca1b61a9f0ddede998d73991e660b",
    "html": "https://github.com/econjobmarket/api_documentation/blob/master/api/Api-Documents.0.md"
  }
}
```
This is what is returned by the github client described above.  In your php program, you would json_decode this reponse to get a simple php object.  The property `content` above is what you want.  If you base64_decode `content`, you'll get the contents of the markdown file.

My favororite markdown parser can be installed using
```
composer require erusev\parsedown
```
which installs  [https://github.com/erusev/parsedown](https://github.com/erusev/parsedown).
You'll need the parser to convert the page to html for display on your website.
