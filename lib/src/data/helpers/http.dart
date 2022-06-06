import 'package:preyecto_tecnologico/src/data/helpers/httpResult.dart';

import 'httpMethod.dart';
import 'sendRequest.dart';

import 'parseResponseBody.dart';

typedef Parser<T> = T Function(dynamic params);

class Http {
  final String baseUrl;

  Http({this.baseUrl = 'https://veranoregional.org'});

  Future<HttpResult<T>> request<T>(
    String path, {
    HttpMethod method = HttpMethod.get,
    Map<String, String> headers = const {},
    Map<String, String> queryParameters = const {},
    dynamic body,
    Parser<T>? parser,
    Duration timeOut = const Duration(seconds: 30),
  }) async {
    int? statusCode;
    dynamic data;
    try {
      late Uri url;
      if (path.startsWith("http://") || path.startsWith("https://")) {
        url = Uri.parse(path);
      } else {
        url = Uri.parse("$baseUrl$path");
      }

      if (queryParameters.isNotEmpty) {
        url = url.replace(
          queryParameters: {
            ...url.queryParameters,
            ...queryParameters,
          },
        );
      }

      final response = await sendRequest(
        url: url,
        method: method,
        headers: headers,
        body: body,
        timeOut: timeOut,
      );

      data = parseResponseBody(response.body);
      statusCode = response.statusCode;
      if (statusCode >= 400) {
        throw HttpError(
            exception: null, stackTrace: StackTrace.current, data: data);
      }

      return HttpResult<T>(
        statusCode: statusCode,
        error: null,
        data: parser != null ? parser(data) : data,
      );
    } catch (e, s) {
      if (e is HttpError) {
        return HttpResult<T>(
          statusCode: statusCode!,
          error: e,
          data: null,
        );
      }

      return HttpResult<T>(
        statusCode: -1,
        error: HttpError(
          exception: e,
          stackTrace: s,
          data: data,
        ),
        data: null,
      );
    }
  }
}
